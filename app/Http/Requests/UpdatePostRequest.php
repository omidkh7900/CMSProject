<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $role = [
            'Title' => 'string|max:255',
            'Content' => 'string|max:5000',
        ];
        if (Auth::user()->hasRole('super-admin'))
            $role['published'] = 'boolean';
        return $role;
    }
}
