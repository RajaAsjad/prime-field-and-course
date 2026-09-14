<?php

namespace App\Http\Requests\Admin;

use App\Support\AffiliateBannerPlacements;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAffiliateBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_name' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:500'],
            'pixel_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'placements' => ['nullable', 'array'],
            'placements.*' => ['string', Rule::in(AffiliateBannerPlacements::keys())],
        ];
    }
}
