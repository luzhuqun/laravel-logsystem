<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class taskFlow extends Eloquent
{
    protected $collection = 'task_flow';
    protected $connection = 'mongodb';
}
