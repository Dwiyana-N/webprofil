<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function article(){
        //return $this->belongsToMany('App\Models\Article', 'article_tags');
        return $this->belongsToMany('App\Models\Article');
    }
}
