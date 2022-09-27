<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

abstract class BaseCategoryRequest extends BaseFormRequest
{
    public function getRules(bool $isCreate): array
    {
        $required = $isCreate ? 'required' : 'sometimes';

        return [
            'name' => [$required],
        ];
    }
}
