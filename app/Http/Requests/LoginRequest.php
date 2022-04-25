<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required'],
            'password' => ['required', 'min:9']
        ];
    }
}
