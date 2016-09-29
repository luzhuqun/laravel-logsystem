<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class taskResult extends Eloquent
{
    protected $collection = 'task_scheduling_result';
    protected $connection = 'mongodb';
}
