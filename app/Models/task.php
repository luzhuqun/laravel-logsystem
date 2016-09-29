<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class task extends Eloquent
{
    protected $collection = 'task_scheduling';
    protected $connection = 'mongodb';
}
