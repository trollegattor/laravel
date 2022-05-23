<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'names'=>['required', 'string', 'max:200'],
            'type'=>['required', 'string', 'in:single,multiple'],
            'parent_id'=>['required', 'integer','nullable', 'in:1,null'],
        ];
    }
}
