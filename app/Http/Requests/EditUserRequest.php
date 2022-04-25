<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseUserRequest;

final class EditUserRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return $this->getRules(false);
    }
}
