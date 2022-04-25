<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseUserRequest;

class CreateUserRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return $this->getRules(true);
    }
}
