<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

abstract class BaseUserRequest extends BaseFormRequest
{
    public function getRules(bool $isCreate): array
    {
        $required = $isCreate ? 'required' : 'sometimes';

        return [
            'first_name' => [$required],
            'last_name' => [$required],
            'email' => [$required, 'email'],
            'password' => [$required, 'min:9'],
        ];
    }
}
