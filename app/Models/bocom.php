<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class bocom extends Eloquent
{
    protected $collection = 'log_list';
    protected $connection = 'mongodb';
}
