<x-filament::page>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Side - Form Card -->
                <div class="lg:col-span-1">
                    <!-- Header Section -->
                    <div class="text-center mb-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="text-orange-500" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-1">Reservation Calculator</h1>
                        <p class="text-sm text-gray-600">Calculate reservation Model 100- Point Roster </p>
                    </div>

                    <!-- Main Card -->
                    <div class="bg-white rounded-lg shadow-lg border-0 overflow-hidden">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M17 20H7m10 0v-2c0-5.07-3.343-9.394-8-10.777M7 20H2v-2a3 3 0 015.196-2.121M7 20v-2c0-5.07 3.343-9.394 8-10.777M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <h2 class="text-lg font-semibold">Position Details</h2>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4">
                            <form wire:submit.prevent="calculateReservation" class="space-y-4">
                                <!-- Cadre Selection -->
                                <div>
                                    <label for="cadre" class="block text-sm font-medium text-gray-700 mb-1">
                                        Select Cadre <span class="text-red-500">*</span>
                                    </label>
                                    <select wire:model="cadreName" 
                                            class="w-full px-3 py-2 border @error('cadreName') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 bg-white text-sm">
                                        <option value="">-- Select Cadre --</option>
                                        @foreach ($cadres as $cadre)
                                            <option value="{{ $cadre->cadre_name }}">{{ $cadre->cadre_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cadreName')
                                        <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Designation Input -->
                                <div>
                                    <label for="designation" class="block text-sm font-medium text-gray-700 mb-1">
                                        Designation <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           wire:model="designation" 
                                           id="designation" 
                                           placeholder="e.g., Assistant Commissioner"
                                           class="w-full px-3 py-2 border @error('designation') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm" />
                                    @error('designation')
                                        <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Vacancy Input -->
                                <div>
                                    <label for="vacancy" class="block text-sm font-medium text-gray-700 mb-1">
                                        Total Vacancy <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" 
                                           wire:model="vacancy" 
                                           id="vacancy" 
                                           placeholder="Enter number of positions" 
                                           min="1"
                                           class="w-full px-3 py-2 border @error('vacancy') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm" />
                                    @error('vacancy')
                                        <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-2">
                                    <x-filament::button 
                                        type="submit" 
                                        color="primary"
                                        wire:loading.attr="disabled"
                                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 disabled:opacity-50">
                                        <span wire:loading.remove>Calculate Reservation</span>
                                        <span wire:loading class="flex items-center gap-2">
                                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Calculating...
                                        </span>
                                    </x-filament::button>
                                </div>
                            </form>

                            <!-- Result Display in Left Panel -->
                            @if($result)
                                <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-md">
                                    <div class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <h3 class="text-sm font-medium text-green-800 mb-1">Quick Result:</h3>
                                            <div class="text-sm text-green-700">
                                                {{ $result }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Side - Detailed Results (Only show after calculation) -->
                @if($result)
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Calculation Results & Detailed Breakdown</h3>
                                <p class="text-sm text-gray-600">Comprehensive analysis of reservation seats</p>
                            </div>

                            <!-- Detailed Results -->
                            <div class="space-y-6">
                                <!-- Summary Cards -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <div class="flex items-center gap-2 mb-2">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M17 20H7m10 0v-2c0-5.07-3.343-9.394-8-10.777M7 20H2v-2a3 3 0 015.196-2.121M7 20v-2c0-5.07 3.343-9.394 8-10.777M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                            <h4 class="font-semibold text-blue-900">Total Positions</h4>
                                        </div>
                                        <p class="text-2xl font-bold text-blue-600">{{ $vacancy }}</p>
                                    </div>

                                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                        <div class="flex items-center gap-2 mb-2">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h4 class="font-semibold text-green-900">Reserved Seats</h4>
                                        </div>
                                        <p class="text-2xl font-bold text-green-600">{{ $reservedSeats }}</p>
                                    </div>

                                    <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                                        <div class="flex items-center gap-2 mb-2">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <h4 class="font-semibold text-orange-900">Unreserved Seats</h4>
                                        </div>
                                        <p class="text-2xl font-bold text-orange-600">{{ $unreservedSeats }}</p>
                                    </div>
                                </div>

                                <!-- Breakdown Table -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-900 mb-3">Position Details</h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between py-2 border-b border-gray-200">
                                            <span class="font-medium">Cadre:</span>
                                            <span>{{ $cadreName }}</span>
                                        </div>
                                        <div class="flex justify-between py-2 border-b border-gray-200">
                                            <span class="font-medium">Designation:</span>
                                            <span>{{ $designation }}</span>
                                        </div>
                                       <div class="p-4 bg-white rounded shadow">
                                        <h2 class="text-lg font-bold mb-4">Vertical Category Seat Allocation</h2>
                                        
                                        @foreach ($verticalCategorySeatAllocationResult as $item)
                                            <div class="flex justify-between py-2 border-b border-gray-200">
                                                <span class="font-medium">{{ $item['category_name'] }} ({{ $item['category_percentage'] }}%)</span>
                                                <span class="text-right">{{ $item['allocated_seats'] }} seats</span>
                                            </div>
                                        @endforeach
                                     </div>
                                     <div class="p-4 bg-white rounded shadow">
                                        <h2 class="text-lg font-bold mb-4">Final Reserved Seat Allocation Summary</h2>
                                        <table class="w-full table-auto border">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="text-left p-2 border">Sl. No</th>
                                                    <th class="text-left p-2 border">Reservation Category</th>
                                                    <th class="text-right p-2 border">No. of Seats</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $count = 1; $totalSeats = 0; @endphp
                                                @foreach ($finalSeatAllocationResult as $item)
                                                    <tr>
                                                        <td class="p-2 border">{{ $count++ }}</td>
                                                        <td class="p-2 border">{{ $item['reservation_category'] }}</td>
                                                        <td class="p-2 border text-right">{{ $item['allocated_seats'] }}</td>
                                                    </tr>
                                                    @php $totalSeats += $item['allocated_seats']; @endphp
                                                @endforeach
                                                <tr class="font-bold bg-gray-100">
                                                    <td class="p-2 border"></td>
                                                    <td class="p-2 border">Total Reserved Vacancy</td>
                                                    <td class="p-2 border text-right">{{ $totalSeats }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                        <!-- <div class="flex justify-between py-2 border-b border-gray-200">
                                            <span class="font-medium">Reservation Percentage:</span>
                                            <span>{{ $reservationPercentage }}%</span>
                                        </div> -->
                                        <div class="flex justify-between py-2">
                                            <span class="font-medium">Calculation Date:</span>
                                            <span>{{ now()->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament::page>