<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.pesan.index', [
            'title' => 'Pesan Masuk - Admin NWCU',
            'messages' => ContactMessage::orderByDesc('created_at')->paginate(15),
            'totalCount' => ContactMessage::count(),
        ]);
    }

    public function show(ContactMessage $message): View
    {
        // Membuka halaman detail otomatis menandai pesan sebagai sudah dibaca.
        $message->markAsRead();

        return view('admin.pesan.show', [
            'title' => 'Pesan dari ' . $message->full_name . ' - Admin NWCU',
            'message' => $message,
        ]);
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.pesan.index')->with('status', 'Pesan dari ' . $message->full_name . ' dihapus.');
    }
}
