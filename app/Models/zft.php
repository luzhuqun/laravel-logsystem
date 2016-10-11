<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class zft extends Eloquent
{
    protected $collection = 'test_zft';
    protected $connection = 'mongodb';

}
