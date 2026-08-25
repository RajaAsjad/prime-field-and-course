<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomepageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'hero.headline_before' => ['nullable', 'string', 'max:255'],
            'hero.headline_highlight' => ['nullable', 'string', 'max:255'],
            'hero.headline_after' => ['nullable', 'string', 'max:255'],
            'hero.subtitle' => ['nullable', 'string', 'max:500'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'hero.cta_primary.label' => ['nullable', 'string', 'max:255'],
            'hero.cta_primary.url' => ['nullable', 'string', 'max:500'],
            'hero.cta_secondary.label' => ['nullable', 'string', 'max:255'],
            'hero.cta_secondary.url' => ['nullable', 'string', 'max:500'],
            'hero.disclaimer' => ['nullable', 'string', 'max:500'],
            'header_ctas.primary.label' => ['nullable', 'string', 'max:255'],
            'header_ctas.primary.url' => ['nullable', 'string', 'max:500'],
            'header_ctas.secondary.label' => ['nullable', 'string', 'max:255'],
            'header_ctas.secondary.url' => ['nullable', 'string', 'max:500'],
            'affiliate_banner.enabled' => ['nullable', 'boolean'],
            'affiliate_banner.brand_name' => ['nullable', 'string', 'max:255'],
            'affiliate_banner.title' => ['nullable', 'string', 'max:500'],
            'affiliate_banner.description' => ['nullable', 'string'],
            'affiliate_banner.cta_label' => ['nullable', 'string', 'max:255'],
            'affiliate_banner.cta_url' => ['nullable', 'string', 'max:500'],
            'affiliate_banner.pixel_url' => ['nullable', 'string', 'max:500'],
            'affiliate_banner.placements' => ['nullable', 'array'],
            'affiliate_banner.placements.*' => ['nullable', 'boolean'],
            'sections.promos.eyebrow' => ['nullable', 'string', 'max:255'],
            'sections.promos.title' => ['nullable', 'string', 'max:255'],
            'sections.promos.subtitle' => ['nullable', 'string'],
            'sections.faq.eyebrow' => ['nullable', 'string', 'max:255'],
            'sections.faq.title' => ['nullable', 'string', 'max:255'],
            'premium.title_before' => ['nullable', 'string', 'max:255'],
            'premium.title_highlight' => ['nullable', 'string', 'max:255'],
            'premium.title_after' => ['nullable', 'string', 'max:255'],
            'premium.subtitle' => ['nullable', 'string'],
            'premium.price' => ['nullable', 'string', 'max:50'],
            'premium.price_unit' => ['nullable', 'string', 'max:50'],
            'premium.features' => ['nullable', 'array'],
            'premium.features.*' => ['nullable', 'string', 'max:500'],
            'premium.form_title_before' => ['nullable', 'string', 'max:255'],
            'premium.form_title_highlight' => ['nullable', 'string', 'max:255'],
            'premium.form_title_after' => ['nullable', 'string', 'max:255'],
            'premium.form_note' => ['nullable', 'string', 'max:500'],
            'testimonials' => ['nullable', 'array'],
            'testimonials.*.quote' => ['nullable', 'string'],
            'testimonials.*.author' => ['nullable', 'string', 'max:255'],
            'testimonials.*.stars' => ['nullable', 'integer', 'min:1', 'max:5'],
        ];
    }
}
