<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackerLog extends Model
{
    protected $fillable = ['ip', 'city', 'ua', 'ref', 'lang'];
}
