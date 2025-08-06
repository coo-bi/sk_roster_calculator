<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadre extends Model
{
    protected $table = 'cadre'; // optional if table name matches convention

    protected $fillable = [
        'cadre_name',
    ];
}
