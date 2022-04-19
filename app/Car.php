<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public $table = 'cars';
    protected $fillable = [
        'carid', 'vehicletype', 'carname', 'carno', 'seat', 'mobile', 'carimage', 'sts'
    ];
}
