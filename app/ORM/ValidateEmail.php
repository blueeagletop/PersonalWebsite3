<?php

namespace App\ORM;

use Illuminate\Database\Eloquent\Model;

class ValidateEmail extends Model
{
    protected $table = 'validate_email';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
