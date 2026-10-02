<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BanomController extends Controller
{
    public function index(): View
    {
        return view('admin.banoms.index', [
            'title' => 'Manajemen Banom - Admin NWCU',
            'banoms' => Banom::withCount('members')->orderBy('sort_order')->orderBy('name')->paginate(15),
            'banomCount' => Banom::count(),
            'activeBanomCount' => Banom::where('is_active', true)->count(),
        ]);
    }

    public function create(): View
    {
        return view('admin.banoms.form', [
            'title' => 'Tambah Banom - Admin NWCU',
            'banom' => new Banom(['is_active' => true]),
            'members' => collect(),
            'action' => route('admin.banoms.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $memberPhotos = $request->file('member_photos', []);

        DB::transaction(function () use ($data, $memberPhotos): void {
            $members = $data['members'] ?? [];
            unset($data['members']);
            $data['slug'] = $this->uniqueSlug($data['name']);
            $data['sort_order'] = (Banom::max('sort_order') ?? 0) + 1;

            $banom = Banom::create($data);
            $this->saveMembers($banom, $members, $memberPhotos);
        });

        return redirect()->route('admin.banoms.index')->with('status', 'Banom berhasil ditambahkan.');
    }

    public function edit(Banom $banom): View
    {
        return view('admin.banoms.form', [
            'title' => 'Ubah ' . $banom->name . ' - Admin NWCU',
            'banom' => $banom,
            'members' => $banom->members,
            'action' => route('admin.banoms.update', $banom),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Banom $banom): RedirectResponse
    {
        $data = $this->validatedData($request);

        $memberPhotos = $request->file('member_photos', []);

        DB::transaction(function () use ($banom, $data, $memberPhotos): void {
            $members = $data['members'] ?? [];
            unset($data['members']);
            $banom->update($data);
            $this->saveMembers($banom, $members, $memberPhotos);
        });

        return redirect()->route('admin.banoms.index')->with('status', 'Perubahan Banom berhasil disimpan.');
    }

    public function destroy(Banom $banom): RedirectResponse
    {
        $banom->delete();

        return redirect()->route('admin.banoms.index')->with('status', 'Banom berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'category' => ['required', 'string', 'max:160'],
            'title' => ['required', 'string', 'max:255'],
            'motto' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'term' => ['nullable', 'string', 'max:120'],
            'member_count' => ['nullable', 'string', 'max:120'],
            'coverage' => ['nullable', 'string', 'max:160'],
            'legal_status' => ['nullable', 'string', 'max:160'],
            'note' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
            'members' => ['nullable', 'array', 'max:100'],
            'members.*.position' => ['required', 'string', 'max:160'],
            'members.*.name' => ['required', 'string', 'max:160'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'banom';
        $slug = $base;
        $suffix = 2;

        while (Banom::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $suffix++;
        }

        return $slug;
    }

    private function saveMembers(Banom $banom, array $members, array $photos = []): void
    {
        $banom->members()->delete();

        foreach (array_values($members) as $sortOrder => $member) {
            $data = [
                'position' => $member['position'],
                'name' => $member['name'],
                'sort_order' => $sortOrder,
            ];

            if (isset($photos[$sortOrder]) && $photos[$sortOrder]) {
                $data['photo_path'] = $photos[$sortOrder]->store('banom_members', 'public');
            }

            $banom->members()->create($data);
        }
    }
}
