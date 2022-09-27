<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseTaskRequest;

final class CreateTaskRequest extends BaseTaskRequest
{
    public function rules(): array
    {
        return $this->getRules(true);
    }
}
