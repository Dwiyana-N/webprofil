<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates=['deleted_at'];
    protected $guarded = [];

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }    

    public function comment(){
        return $this->hasMany(Comment::class);
    }

}
