<?php

namespace App\ORM;

use Illuminate\Database\Eloquent\Model;

class ArticleDetail extends Model
{
    protected $table = 'article_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
