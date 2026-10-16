<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartaNu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class KartaNuController extends Controller
{
    public function index(): View
    {
        return view('admin.kartanu.index', [
            'title' => 'Verifikasi & Keputusan Sensus KartaNU - Admin NWCU',
            'records' => KartaNu::orderByRaw("CASE verification_status WHEN 'submitted' THEN 0 ELSE 1 END")->orderByDesc('updated_at')->paginate(20),
            'totalCount' => KartaNu::count(),
            'pendingCount' => KartaNu::whereIn('verification_status', ['submitted', 'branch_verified', 'mwc_verified'])->count(),
            'approvedCount' => KartaNu::where('verification_status', 'issued')->count(),
            'rejectedCount' => KartaNu::where('verification_status', 'rejected')->count(),
        ]);
    }

    public function approve(KartaNu $kartanu): RedirectResponse
    {
        $kartanu->update([
            'verification_status' => 'issued',
            'verification_note' => $kartanu->verification_note ?: 'Disetujui oleh Sekretariat MWCNU pada '.now()->translatedFormat('d F Y'),
        ]);

        return back()->with('status', 'Pendaftaran '.$kartanu->name.' telah disetujui.');
    }

    public function reject(Request $request, KartaNu $kartanu): RedirectResponse
    {
        $validated = $request->validate([
            'verification_note' => ['required', 'string', 'max:255'],
        ]);

        $kartanu->update([
            'verification_status' => 'rejected',
            'verification_note' => $validated['verification_note'],
        ]);

        return back()->with('status', 'Pendaftaran '.$kartanu->name.' telah ditolak.');
    }

    public function show(KartaNu $kartanu): View
    {
        return view('admin.kartanu.show', [
            'title' => 'Detail '.$kartanu->name.' - Admin NWCU',
            'record' => $kartanu,
        ]);
    }

    public function print(KartaNu $kartanu): View
    {
        return view('admin.kartanu.print', [
            'record' => $kartanu,
        ]);
    }

    public function create(): View
    {
        return view('admin.kartanu.form', [
            'title' => 'Tambah Anggota KartaNU - Admin NWCU',
            'record' => new KartaNu(['verification_status' => 'submitted']),
            'action' => route('admin.kartanu.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $photo = $data['photo'] ?? null;
        unset($data['photo']);
        $data['nik'] = $data['nik'] ?: null;
        $data['nik_hash'] = $data['nik'] ? $this->nikHash($data['nik']) : null;
        $data['registration_code'] = $this->registrationCode();

        if ($photo) {
            $data['photo_path'] = $photo->store('kartanu', 'public');
        }

        $record = KartaNu::create($data);

        return redirect()->route('admin.kartanu.index')->with('status', 'Data KartaNU berhasil ditambahkan.');
    }

    public function edit(KartaNu $kartanu): View
    {
        return view('admin.kartanu.form', [
            'title' => 'Ubah Data KartaNU - Admin NWCU',
            'record' => $kartanu,
            'action' => route('admin.kartanu.update', $kartanu),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, KartaNu $kartanu): RedirectResponse
    {
        $data = $this->validatedData($request, $kartanu);
        $photo = $data['photo'] ?? null;
        unset($data['photo']);
        $data['nik'] = $data['nik'] ?: null;
        $data['nik_hash'] = $data['nik'] ? $this->nikHash($data['nik']) : null;

        if ($photo) {
            if ($kartanu->photo_path) {
                Storage::disk('public')->delete($kartanu->photo_path);
            }

            $data['photo_path'] = $photo->store('kartanu', 'public');
        }

        $kartanu->update($data);

        return redirect()->route('admin.kartanu.index')->with('status', 'Perubahan data KartaNU berhasil disimpan.');
    }

    public function destroy(KartaNu $kartanu): RedirectResponse
    {
        if ($kartanu->photo_path) {
            Storage::disk('public')->delete($kartanu->photo_path);
        }

        $kartanu->delete();

        return redirect()->route('admin.kartanu.index')->with('status', 'Data KartaNU berhasil dihapus.');
    }

    private function validatedData(Request $request, ?KartaNu $record = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nia' => ['required', 'string', 'max:40', Rule::unique('kartanu_records', 'nia')->ignore($record?->id)],
            'nik' => ['nullable', 'digits:16'],
            'branch_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['nullable', 'string', 'max:120'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'verification_status' => ['required', Rule::in(['submitted', 'branch_verified', 'mwc_verified', 'issued', 'rejected'])],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'verification_note' => ['nullable', 'string', 'max:255'],
        ]);

        if ($data['nik'] ?? null) {
            $duplicateNik = KartaNu::where('nik_hash', $this->nikHash($data['nik']))
                ->when($record, fn ($query) => $query->whereKeyNot($record->id))
                ->exists();

            if ($duplicateNik) {
                throw ValidationException::withMessages(['nik' => 'NIK tersebut sudah terdaftar.']);
            }
        }

        return $data;
    }

    private function nikHash(string $nik): string
    {
        return hash_hmac('sha256', $nik, (string) config('app.key'));
    }

    private function registrationCode(): string
    {
        do {
            $code = 'REG-GML-'.now()->format('Y').'-'.Str::upper(Str::random(8));
        } while (KartaNu::where('registration_code', $code)->exists());

        return $code;
    }
}
