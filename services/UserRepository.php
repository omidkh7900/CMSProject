<?php


namespace Services;


use App\Models\Post;

interface UserRepository
{
    public function whereStatus($status);

    public function delete($trashed, Post $post);
}
