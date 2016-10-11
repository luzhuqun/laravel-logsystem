<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class bocom extends Eloquent
{
    protected $collection = 'test_jh';
    protected $connection = 'mongodb';
}
