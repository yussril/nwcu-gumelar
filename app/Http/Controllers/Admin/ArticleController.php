<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('admin.articles.index', [
            'title' => 'Warta Nahdliyin - Admin NWCU',
            'articles' => Article::orderByDesc('published_at')->orderByDesc('id')->paginate(15),
            'articleCount' => Article::count(),
            'publishedArticleCount' => Article::where('is_published', true)->count(),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.form', [
            'title' => 'Tulis Warta Nahdliyin - Admin NWCU',
            'article' => new Article([
                'is_published' => true,
                'visibility' => 'public',
                'publish_mode' => 'now',
                'tags' => [],
            ]),
            'action' => route('admin.articles.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $image = $data['image'] ?? null;
        unset($data['image']);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['sort_order'] = (Article::max('sort_order') ?? 0) + 1;
        $data['is_published'] = true;

        // Handle tags - convert from comma-separated string to array
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        if ($image) {
            $data['image_path'] = $image->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('status', 'Warta Nahdliyin berhasil disimpan.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.form', [
            'title' => 'Ubah Warta Nahdliyin - Admin NWCU',
            'article' => $article,
            'action' => route('admin.articles.update', $article),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validatedData($request);
        $image = $data['image'] ?? null;
        unset($data['image']);
        $data['is_featured'] = false;
        $data['is_published'] = true;

        // Handle tags - convert from comma-separated string to array
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        if ($article->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $article->id);
        }

        if ($image) {
            if ($article->image_path) {
                Storage::disk('public')->delete($article->image_path);
            }

            $data['image_path'] = $image->store('articles', 'public');
        } elseif ($article->image_path && $article->image_url !== $data['image_url']) {
            Storage::disk('public')->delete($article->image_path);
            $data['image_path'] = null;
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('status', 'Perubahan Warta Nahdliyin berhasil disimpan.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('status', 'Warta Nahdliyin berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['required', 'string', 'max:2000'],
            'body' => ['nullable', 'string', 'max:50000'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'image' => ['nullable', 'image', 'max:5120'],
            'author' => ['nullable', 'string', 'max:160'],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            // Social Media Official MWCNU Gumelar
            'social_facebook' => ['nullable', 'url', 'max:2048'],
            'social_twitter' => ['nullable', 'url', 'max:2048'],
            'social_instagram' => ['nullable', 'url', 'max:2048'],
            'social_youtube' => ['nullable', 'url', 'max:2048'],
            'social_whatsapp' => ['nullable', 'url', 'max:2048'],
            'social_website' => ['nullable', 'url', 'max:2048'],
            // Tags
            'tags' => ['nullable', 'string'],
            // Visibility / Access
            'visibility' => ['nullable', 'string', 'in:public,karta_nu,internal'],
            // Publish mode
            'publish_mode' => ['nullable', 'string', 'in:now,scheduled'],
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'warta';
        $slug = $base;
        $suffix = 2;

        while (Article::where('slug', $slug)->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))->exists()) {
            $slug = $base . '-' . $suffix++;
        }

        return $slug;
    }
}