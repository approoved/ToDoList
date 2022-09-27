<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseCategoryRequest;

final class EditCategoryRequest extends BaseCategoryRequest
{
    public function rules(): array
    {
        return $this->getRules(false);
    }
}
