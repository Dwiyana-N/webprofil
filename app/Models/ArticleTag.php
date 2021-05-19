<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    // public function article(){
    //     return $this->belongsTo(Article::class, 'article_id', 'id');
    // }

    // public function tag(){
    //     return $this->belongsTo(Tag::class, 'tag_id', 'id');
    // }
}
