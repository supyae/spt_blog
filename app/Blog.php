<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body', 'privacy'
    ];

    protected $table="blog";

    public function comment() {
        //return $this->hasMany(Comment::class, 'blog_id')->orderBy('created_at', 'DESC');

        return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'DESC');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
