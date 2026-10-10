<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'contact_point' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(ContactMessage::CATEGORIES))],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return redirect()->route('kontak')->with(
            'success',
            'Pesan diterima sekretariat dan akan dibalas melalui kontak yang Anda cantumkan dalam 1x24 jam kerja.'
        );
    }
}
