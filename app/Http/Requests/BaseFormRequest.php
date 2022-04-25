<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    abstract function rules(): array;

    public function authorize(): bool
    {
        return true;
    }
}
