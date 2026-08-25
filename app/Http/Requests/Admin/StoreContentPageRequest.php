<?php

namespace App\Http\Requests\Admin;

use App\Models\ContentPage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContentPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:content_pages,slug'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'type' => ['required', Rule::in(array_keys(ContentPage::TYPES))],
            'body' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'show_in_footer' => ['nullable', 'boolean'],
            'footer_label' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'content' => ['nullable', 'array'],
        ], $this->contentRules());
    }

    protected function contentRules(): array
    {
        return [
            'content.terms' => ['exclude_unless:type,glossary', 'nullable', 'array'],
            'content.terms.*.term' => ['nullable', 'string', 'max:255'],
            'content.terms.*.definition' => ['nullable', 'string'],
            'content.terms.*.example' => ['nullable', 'string'],
            'content.terms.*.alias' => ['nullable', 'string', 'max:255'],

            'content.apps' => ['exclude_unless:type,apps', 'nullable', 'array'],
            'content.apps.*.name' => ['nullable', 'string', 'max:255'],
            'content.apps.*.tagline' => ['nullable', 'string', 'max:255'],
            'content.apps.*.description' => ['nullable', 'string'],
            'content.apps.*.pros' => ['nullable', 'array'],
            'content.apps.*.pros.*' => ['nullable', 'string', 'max:255'],
            'content.apps.*.cons' => ['nullable', 'array'],
            'content.apps.*.cons.*' => ['nullable', 'string', 'max:255'],
            'content.apps.*.tip' => ['nullable', 'string'],

            'content.tips' => ['exclude_unless:type,apps', 'nullable', 'array'],
            'content.tips.*.title' => ['nullable', 'string', 'max:255'],
            'content.tips.*.text' => ['nullable', 'string'],

            'content.sections' => ['exclude_unless:type,guide', 'nullable', 'array'],
            'content.sections.*.id' => ['nullable', 'string', 'max:255'],
            'content.sections.*.title' => ['nullable', 'string', 'max:255'],
            'content.sections.*.content' => ['nullable', 'string'],
            'content.sections.*.paragraphs' => ['nullable', 'array'],
            'content.sections.*.paragraphs.*' => ['nullable', 'string'],
            'content.sections.*.list' => ['nullable', 'array'],
            'content.sections.*.list.*' => ['nullable', 'string'],
        ];
    }
}
