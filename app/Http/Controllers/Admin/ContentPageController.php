<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContentPageRequest;
use App\Http\Requests\Admin\UpdateContentPageRequest;
use App\Models\ContentPage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentPageController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $pages = ContentPage::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.content-pages.index', compact('pages', 'search'));
    }

    public function create(): View
    {
        $page = new ContentPage(['type' => 'generic', 'is_published' => true]);

        return view('screens.admin.content-pages.create', compact('page'));
    }

    public function store(StoreContentPageRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request);
        ContentPage::create($data);

        return redirect()
            ->route('admin.content-pages.index')
            ->with('success', 'Content page created successfully.');
    }

    public function edit(ContentPage $contentPage): View
    {
        return view('screens.admin.content-pages.edit', ['page' => $contentPage]);
    }

    public function update(UpdateContentPageRequest $request, ContentPage $contentPage): RedirectResponse
    {
        $contentPage->update($this->prepareData($request));

        return redirect()
            ->route('admin.content-pages.index')
            ->with('success', 'Content page updated successfully.');
    }

    public function destroy(ContentPage $contentPage): RedirectResponse
    {
        $contentPage->delete();

        return redirect()
            ->route('admin.content-pages.index')
            ->with('success', 'Content page deleted successfully.');
    }

    private function prepareData(StoreContentPageRequest|UpdateContentPageRequest $request): array
    {
        $data = $request->safe()->except(['content']);
        $data['is_published'] = $request->boolean('is_published');
        $data['show_in_footer'] = $request->boolean('show_in_footer');
        $content = $request->input('content', []);
        $data['content'] = $this->normalizeContent(
            (string) $request->input('type'),
            is_array($content) ? $content : []
        );

        if (! empty($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        } else {
            unset($data['slug']);
        }

        return $data;
    }

    private function normalizeContent(string $type, array $content): array
    {
        return match ($type) {
            'glossary' => ['terms' => $this->normalizeTerms($content['terms'] ?? [])],
            'apps' => [
                'apps' => $this->normalizeApps($content['apps'] ?? []),
                'tips' => $this->normalizeTips($content['tips'] ?? []),
            ],
            'guide' => ['sections' => $this->normalizeSections($content['sections'] ?? [])],
            default => [],
        };
    }

    private function normalizeTerms(array $rows): array
    {
        return collect($rows)
            ->map(function ($row) {
                $row = is_array($row) ? $row : [];
                $term = trim((string) ($row['term'] ?? ''));
                $definition = trim((string) ($row['definition'] ?? ''));
                $example = trim((string) ($row['example'] ?? ''));
                $alias = trim((string) ($row['alias'] ?? ''));

                if ($term === '' && $definition === '') {
                    return null;
                }

                $item = compact('term', 'definition');
                if ($alias !== '') {
                    $item['alias'] = $alias;
                }
                if ($example !== '') {
                    $item['example'] = $example;
                }

                return $item;
            })
            ->filter()
            ->values()
            ->all();
    }

    private function normalizeApps(array $rows): array
    {
        return collect($rows)
            ->map(function ($row) {
                $row = is_array($row) ? $row : [];
                $name = trim((string) ($row['name'] ?? ''));
                $tagline = trim((string) ($row['tagline'] ?? ''));
                $description = trim((string) ($row['description'] ?? ''));
                $tip = trim((string) ($row['tip'] ?? ''));
                $pros = $this->linesToArray($row['pros'] ?? '');
                $cons = $this->linesToArray($row['cons'] ?? '');

                if ($name === '' && $tagline === '' && $description === '' && $tip === '' && $pros === [] && $cons === []) {
                    return null;
                }

                return compact('name', 'tagline', 'description', 'pros', 'cons', 'tip');
            })
            ->filter()
            ->values()
            ->all();
    }

    private function normalizeTips(array $rows): array
    {
        return collect($rows)
            ->map(function ($row) {
                $row = is_array($row) ? $row : [];
                $title = trim((string) ($row['title'] ?? ''));
                $text = trim((string) ($row['text'] ?? ''));

                if ($title === '' && $text === '') {
                    return null;
                }

                return compact('title', 'text');
            })
            ->filter()
            ->values()
            ->all();
    }

    private function normalizeSections(array $rows): array
    {
        return collect($rows)
            ->map(function ($row) {
                $row = is_array($row) ? $row : [];
                $title = trim((string) ($row['title'] ?? ''));
                $lead = trim((string) ($row['content'] ?? ''));
                $id = trim((string) ($row['id'] ?? ''));
                $paragraphs = $this->linesToArray($row['paragraphs'] ?? '');
                $list = $this->linesToArray($row['list'] ?? '');

                if ($title === '' && $lead === '' && $paragraphs === [] && $list === []) {
                    return null;
                }

                $item = [
                    'id' => $id !== '' ? Str::slug($id) : Str::slug($title),
                    'title' => $title,
                ];
                if ($lead !== '') {
                    $item['content'] = $lead;
                }
                if ($paragraphs !== []) {
                    $item['paragraphs'] = $paragraphs;
                }
                if ($list !== []) {
                    $item['list'] = $list;
                }

                return $item;
            })
            ->filter()
            ->values()
            ->all();
    }

    private function linesToArray(mixed $value): array
    {
        if (is_array($value)) {
            return array_values(array_filter(array_map('trim', $value), fn (string $line) => $line !== ''));
        }

        $lines = preg_split('/\R/u', (string) $value) ?: [];

        return array_values(array_filter(array_map('trim', $lines), fn (string $line) => $line !== ''));
    }
}
