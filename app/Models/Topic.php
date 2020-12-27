<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Topic extends Model 
{
    
    protected $primaryKey = 'topic_id';
    protected $fillable = [
       'topic_name', 'slug'
    ];  

    public function article()
    {
        return $this->hasMany('App\Article');
    }
}
