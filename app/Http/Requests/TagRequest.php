<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

final class TagRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
        ];
    }
}
