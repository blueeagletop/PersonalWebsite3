<?php

namespace App\ORM;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
