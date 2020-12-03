<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Title' => 'Required|String|Max:255',
            'Content' => 'Required|String|Max:65534',
        ];
    }
}
