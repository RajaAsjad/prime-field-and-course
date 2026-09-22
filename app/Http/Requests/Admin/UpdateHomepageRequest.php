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
            'sections' => ['nullable', 'array'],
            'sections.*.eyebrow' => ['nullable', 'string', 'max:255'],
            'sections.*.title' => ['nullable', 'string', 'max:255'],
            'sections.*.title_em' => ['nullable', 'string', 'max:255'],
            'sections.*.subtitle' => ['nullable', 'string'],
            'sections.*.newsletter_eyebrow' => ['nullable', 'string', 'max:255'],
            'sections.*.newsletter_title' => ['nullable', 'string', 'max:255'],
            'sections.*.newsletter_subtitle' => ['nullable', 'string', 'max:500'],
            'sections.*.newsletter_button' => ['nullable', 'string', 'max:255'],
            'sections.*.guides' => ['nullable', 'array'],
            'sections.*.guides.*.icon' => ['nullable', 'string', 'max:20'],
            'sections.*.guides.*.title' => ['nullable', 'string', 'max:255'],
            'sections.*.guides.*.meta' => ['nullable', 'string', 'max:255'],
            'sections.*.guides.*.url' => ['nullable', 'string', 'max:500'],
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
            'seo.meta_title' => ['nullable', 'string', 'max:255'],
            'seo.meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
