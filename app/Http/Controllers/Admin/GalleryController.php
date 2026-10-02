<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\GalleryPhoto;
use App\Services\KegiatanMover;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        // Sinkronkan arsip dengan kegiatan yang sudah selesai pelaksanaannya.
        KegiatanMover::moveDue();

        return view('admin.gallery.index', [
            'title' => 'Galeri Dokumentasi - Admin NWCU',
            'items' => GalleryItem::withCount('photos')->orderByDesc('event_date')->orderByDesc('id')->paginate(15),
        ]);
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('admin.gallery.form', [
            'title' => 'Foto Kegiatan - Admin NWCU',
            'item' => $gallery,
        ]);
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        foreach ($gallery->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('status', 'Dokumentasi berhasil dihapus.');
    }

    public function addPhoto(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $request->validate([
            'photo' => ['required', 'image', 'max:5120'],
            'caption' => ['nullable', 'string', 'max:255'],
        ]);

        $path = $data['photo']->store('gallery_photos', 'public');

        $gallery->photos()->create([
            'photo_path' => $path,
            'caption' => $data['caption'] ?? null,
            'sort_order' => ($gallery->photos()->max('sort_order') ?? 0) + 1,
        ]);

        return back()->with('status', 'Foto berhasil ditambahkan.');
    }

    public function deletePhoto(GalleryItem $gallery, GalleryPhoto $photo): RedirectResponse
    {
        if ($photo->gallery_item_id !== $gallery->id) {
            abort(403);
        }

        Storage::disk('public')->delete($photo->photo_path);
        $photo->delete();

        return back()->with('status', 'Foto berhasil dihapus.');
    }
}
