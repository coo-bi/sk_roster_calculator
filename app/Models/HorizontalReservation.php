<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorizontalReservation extends Model
{
    protected $table = 'horizontal_reservations'; // optional if table name matches convention

    protected $fillable = [
        'category_name',
        'category_percentage',
    ];
}
