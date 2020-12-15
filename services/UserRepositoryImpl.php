<?php

namespace Services;

use App\Models\Post;

class UserRepositoryImpl implements UserRepository
{
    public function whereStatus($status)
    {
        switch ($status) {
            case Post::STATUS_DELETED:
                $posts = Post::onlyTrashed();
                break;
            case Post::STATUS_UNPUBLISHED:
                $posts = Post::where(Post::STATUS_PUBLISHED, '=', 0);
                break;
            default:
                $posts = Post::where(Post::STATUS_PUBLISHED, '=', 1);
        }
        return $posts->paginate(20);
    }
}
