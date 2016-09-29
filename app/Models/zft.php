<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class zft extends Eloquent
{
    protected $collection = 'zftlogmodel';
    protected $connection = 'mongodb';
    protected $dates = ['Time'];
}
