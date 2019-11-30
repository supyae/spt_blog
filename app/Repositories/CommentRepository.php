<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository extends GeneralRepository
{
    public function __construct()
    {
        parent::__construct(new Comment());
    }

}