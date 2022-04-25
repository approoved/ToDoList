<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseUserRequest;

final class CreateUserRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return $this->getRules(true);
    }
}
