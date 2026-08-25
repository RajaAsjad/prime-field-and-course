<?php

namespace App\Http\Requests\Admin;

use App\Models\NavigationLink;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNavigationLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'label' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:500'],
            'location' => ['required', Rule::in(array_keys(NavigationLink::LOCATIONS))],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'open_new_tab' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
