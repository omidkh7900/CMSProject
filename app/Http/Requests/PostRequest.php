<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            Post::STATUS => ['required', Rule::in([Post::STATUS_DELETED, Post::STATUS_PUBLISHED, Post::STATUS_UNPUBLISHED])]
        ];
    }
}
