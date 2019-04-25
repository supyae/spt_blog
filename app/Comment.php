<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blog_id', 'parent_id', 'user_id', 'message', 'commentable_id', 'commentable_type'
    ];

    protected $table="comment";


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function reply()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'ASC');
    }
}
