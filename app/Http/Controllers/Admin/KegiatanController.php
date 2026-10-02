<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KegiatanController extends Controller
{
    public function index(): View
    {
        return view('admin.kegiatans.index', [
            'title' => 'Kegiatan - Admin NWCU',
            'kegiatans' => Kegiatan::orderBy('scheduled_at')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.kegiatans.form', [
            'title' => 'Tambah Kegiatan - Admin NWCU',
            'kegiatan' => new Kegiatan(['is_published' => true]),
            'action' => route('admin.kegiatans.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $cover = $data['cover_image'] ?? null;
        unset($data['cover_image']);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['sort_order'] = (Kegiatan::max('sort_order') ?? 0) + 1;
        $data['is_published'] = $request->boolean('is_published');

        if ($cover) {
            $data['cover_image_path'] = $cover->store('kegiatans', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatans.index')->with('status', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan): View
    {
        return view('admin.kegiatans.form', [
            'title' => 'Ubah Kegiatan - Admin NWCU',
            'kegiatan' => $kegiatan,
            'action' => route('admin.kegiatans.update', $kegiatan),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Kegiatan $kegiatan): RedirectResponse
    {
        $data = $this->validatedData($request);
        $cover = $data['cover_image'] ?? null;
        unset($data['cover_image']);

        if ($kegiatan->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $kegiatan->id);
        }

        $data['is_published'] = $request->boolean('is_published');

        if ($cover) {
            if ($kegiatan->cover_image_path) {
                Storage::disk('public')->delete($kegiatan->cover_image_path);
            }

            $data['cover_image_path'] = $cover->store('kegiatans', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatans.index')->with('status', 'Perubahan kegiatan berhasil disimpan.');
    }

    public function destroy(Kegiatan $kegiatan): RedirectResponse
    {
        if ($kegiatan->cover_image_path) {
            Storage::disk('public')->delete($kegiatan->cover_image_path);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatans.index')->with('status', 'Kegiatan berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'location' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'scheduled_at' => ['required', 'date'],
            'scheduled_end_at' => ['required', 'date', 'after:scheduled_at'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'kegiatan';
        $slug = $base;
        $suffix = 2;

        while (Kegiatan::where('slug', $slug)->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))->exists()) {
            $slug = $base . '-' . $suffix++;
        }

        return $slug;
    }
}
