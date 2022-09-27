<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseTaskRequest;

final class EditTaskRequest extends BaseTaskRequest
{
    public function rules(): array
    {
        return $this->getRules(false);
    }
}
