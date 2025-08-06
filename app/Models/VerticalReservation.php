<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerticalReservation extends Model
{
    protected $table = 'vertical_reservations'; // optional if table name matches convention

    protected $fillable = [
        'category_name',
        'category_percentage',
    ];
}
