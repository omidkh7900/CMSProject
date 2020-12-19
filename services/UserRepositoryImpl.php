<?php

namespace Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UserRepositoryImpl implements UserRepository
{
    public function whereStatus($status = 'without trashed', $paginate = 20)
    {
        switch ($status) {
            case Post::STATUS_DELETED:
                $posts = Post::onlyTrashed();
                break;
            case Post::STATUS_UNPUBLISHED:
                $posts = Post::where(Post::STATUS, 0);
                break;
            case Post::STATUS_PUBLISHED:
                $posts = Post::where(Post::STATUS, 1);
                break;
            case 'all':
                $posts = Post::withTrashed();
                break;
            default:
                $posts = Post::withoutTrashed();
        }
        return $posts->paginate($paginate);
    }

    public function delete($trashed, Post $post)
    {
        if ($trashed) {
            Storage::delete(explode('app/', $post->image->Path)[1]);
            $post->forceDelete();
        } else {
            $post->delete();
        }

    }
}
