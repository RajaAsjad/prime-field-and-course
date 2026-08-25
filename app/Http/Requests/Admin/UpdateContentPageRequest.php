<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class UpdateContentPageRequest extends StoreContentPageRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['slug'] = ['nullable', 'string', 'max:255', Rule::unique('content_pages', 'slug')->ignore($this->route('content_page'))];

        return $rules;
    }
}
