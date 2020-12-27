<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{
    protected $primaryKey = 'article_id';

    protected $fillable = [
        'title', 'body', 'slug', 'topic_id'
    ];  

    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }
}