<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Cadre;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\VerticalReservation;
use App\Models\HorizontalReservation;



class Dashboard extends Page
{
    protected static string $view = 'filament.pages.calculate-reservation';

    public $cadreId;
    public $designation;
    public $vacancy;
    public $result;
    public $cadres;
    public $verticalReservation;
    public $horizontalReservation;
    public $cadreName;
    public $unreservedSeats;
    public $reservedSeats;
    public $reservationPercentage;
    public $verticalCategorySeatAllocationResult = [];
    public $horizontalCategorySeatAllocationResult = [];
    public $finalSeatAllocationResult = [];
    

    protected $rules = [
        'cadreName' => 'required|string',
        'designation' => 'required|string|max:255',
        'vacancy' => 'required|integer|min:1',
    ];

     protected $messages = [
        'cadreName.required' => 'Please select a cadre.',
        'designation.required' => 'Designation is required.',
        'designation.max' => 'Designation must not exceed 255 characters.',
        'vacancy.required' => 'Vacancy field is required.',
        'vacancy.integer' => 'Vacancy must be a number.',
        'vacancy.min' => 'Vacancy must be at least 1.',
    ];

    public function mount(): void
    {
        $this->cadres = Cadre::all();
        $this->verticalReservation = VerticalReservation::all();
        $this->horizontalReservation = HorizontalReservation::all(); 
    }

    function customRound($value) {
        $intValue = (int) $value;
        $decimalPart = $value - $intValue;
        if ($decimalPart <= 0.5) {
            return $intValue;
        } else {
            return $intValue + 1;
        }
    }


    public function calculateReservation()
    {
        $this->validate();
    
        $this->verticalCategorySeatAllocationResult = $this->calculateVerticalCategorySeats($this->vacancy);
        $this->horizontalCategorySeatAllocationResult = $this->calculateHorizontalCategorySeats($this->verticalCategorySeatAllocationResult);
        $this->finalSeatAllocationResult = $this->generateFinalSeatAllocation($this->horizontalCategorySeatAllocationResult);

        //$this->reservationPercentage = VerticalReservation::sum('category_percentage');
        $this->result = "Cadre Name: {$this->cadreName}, 
        Designation: {$this->designation}, 
        Vacancy: {$this->vacancy}, 
        Reserved Seats: {$this->reservedSeats}, 
        Unreserved Seats: {$this->unreservedSeats}";

        // TODO: Add actual reservation logic here
    }


    private function calculateVerticalCategorySeats($vacancy)
    {
        $verticalReservations = VerticalReservation::all();
        $verticalTotalPercentage = $verticalReservations->sum('category_percentage');

        if ($verticalTotalPercentage > 100) {
            throw new \Exception("Total category percentage exceeds 100%");
        }

        $verticalCategorySeats = [];
        $reservedSeatsSum = 0;

        foreach ($verticalReservations as $category) {
            $seats = $this->customRound(($category->category_percentage / 100 * $vacancy));
            $reservedSeatsSum += $seats;
            $this->reservedSeats = $reservedSeatsSum;
            $verticalCategorySeats[] = [
                'category_name' => $category->category_name,
                'category_percentage' => $category->category_percentage,
                'allocated_seats' => $seats,
            ];
        }


        $unreservedSeats = $vacancy - $reservedSeatsSum;
        $this->unreservedSeats = $unreservedSeats;
        // Add unreserved category
        $verticalCategorySeats[] = [
            'category_name' => 'Unreserved',
            'category_percentage' => 100 - $verticalTotalPercentage,
            'allocated_seats' => $unreservedSeats,
        ];

        return $verticalCategorySeats;
    }

    private function calculateHorizontalCategorySeats(array $verticalCategorySeats)
    {
        $horizontalReservations = HorizontalReservation::all();

        $result = [];

        foreach ($verticalCategorySeats as $verticalCategory) {
            $verticalSeatCount = $verticalCategory['allocated_seats'];

            // Skip 'Unreserved' category if you don't want horizontal reservation on it
            if ($verticalCategory['category_name'] === 'Unreserved') {
                continue;
            }

            $horizontalAllocations = [];
            $horizontalTotal = 0;

            foreach ($horizontalReservations as $hr) {
                $percentage = $hr->category_percentage / 100;
                $allocated = $this->customRound($verticalSeatCount * $percentage);
                $horizontalTotal += $allocated;

                $horizontalAllocations[] = [
                    'horizontal_category_name' => $hr->category_name,
                    'category_percentage' => $hr->category_percentage,
                    'allocated_seats' => $allocated,
                ];
            }

            $result[] = [
                'vertical_category_name' => $verticalCategory['category_name'],
                'vertical_allocated_seats' => $verticalSeatCount,
                'horizontal_reservations' => $horizontalAllocations,
                'general_seats' => $verticalSeatCount - $horizontalTotal,
            ];
        }

        return $result;
    }
    
    private function generateFinalSeatAllocation(array $horizontalCategorySeats): array
    {
        $finalList = [];
        
        foreach ($horizontalCategorySeats as $category) {
            // General (non-horizontal) reservation entry
            if ($category['general_seats'] > 0) {
                $finalList[] = [
                    'reservation_category' => $category['vertical_category_name'] . ' (General)',
                    'allocated_seats' => $category['general_seats'],
                ];
            }

            // Horizontal reservations under this category
            foreach ($category['horizontal_reservations'] as $hr) {
                if ($hr['allocated_seats'] > 0) {
                    $finalList[] = [
                        'reservation_category' => $category['vertical_category_name'] . ' (' . $hr['horizontal_category_name'] . ')',
                        'allocated_seats' => $hr['allocated_seats'],
                    ];
                }
            }
        }

        return $finalList;
    }





}
