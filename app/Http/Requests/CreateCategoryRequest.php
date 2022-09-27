<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseCategoryRequest;

final class CreateCategoryRequest extends BaseCategoryRequest
{
    public function rules(): array
    {
        return $this->getRules(true);
    }
}
