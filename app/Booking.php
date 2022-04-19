<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $table = 'bookings';
    protected $fillable = [
        'bookid', 'carid', 'cid', 'pickup','destination', 'bookdate', 'starttime', 'endtime', 'mobile','offer', 'status', 'response'
    ];
}
