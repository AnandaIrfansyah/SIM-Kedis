<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DataKendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('pages.admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('pages.admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'no_polisi' => 'required|string|max:20|unique:kendaraans,no_polisi',
            'no_rangka' => 'nullable|string|max:50|unique:kendaraans,no_rangka',
            'no_mesin' => 'nullable|string|max:50|unique:kendaraans,no_mesin',
            'tahun' => 'required|digits:4',
            'jenis' => 'nullable|string|max:20',
            'jatuh_tempo_pajak' => 'nullable|date',
            'jatuh_tempo_stnk' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'no_polisi.unique' => 'Nomor polisi sudah terdaftar.',
            'merk.required' => 'Merk kendaraan wajib diisi.',
            'tipe.required' => 'Tipe kendaraan wajib diisi.',
            'tahun.digits' => 'Tahun harus berupa 4 digit angka.',
        ]);

        // Ambil semua data dari form
        $data = $request->all();

        // Upload foto kendaraan jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        }

        // Generate QR Code unik
        $data['qr_code'] = 'KEND-' . strtoupper(uniqid());

        // Simpan ke database
        $kendaraan = Kendaraan::create($data);

        // Generate file gambar QR Code
        $qrImage = QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->generate(route('kendaraan.show', $kendaraan->id));

        Storage::disk('public')->put('qr_code/' . $kendaraan->id . '.png', $qrImage);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('pages.admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'merk' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'no_polisi' => 'required|string|max:20|unique:kendaraans,no_polisi,' . $kendaraan->id,
            'no_rangka' => 'nullable|string|max:50|unique:kendaraans,no_rangka,' . $kendaraan->id,
            'no_mesin' => 'nullable|string|max:50|unique:kendaraans,no_mesin,' . $kendaraan->id,
            'tahun' => 'required|digits:4',
            'jenis' => 'nullable|string|max:20',
            'jatuh_tempo_pajak' => 'nullable|date',
            'jatuh_tempo_stnk' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'no_polisi.unique' => 'Nomor polisi sudah terdaftar.',
            'merk.required' => 'Merk kendaraan wajib diisi.',
            'tipe.required' => 'Tipe kendaraan wajib diisi.',
            'tahun.digits' => 'Tahun harus berupa 4 digit angka.',
        ]);

        $data = $request->all();

        // Update foto jika ada file baru
        if ($request->hasFile('foto')) {
            if ($kendaraan->foto && Storage::disk('public')->exists($kendaraan->foto)) {
                Storage::disk('public')->delete($kendaraan->foto);
            }
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        }

        $kendaraan->update($data);

        // Regenerate QR Code (overwrite lama)
        $qrImage = QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->generate(route('kendaraan.show', $kendaraan->id));

        Storage::disk('public')->put('qr_code/' . $kendaraan->id . '.png', $qrImage);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan->foto && Storage::disk('public')->exists($kendaraan->foto)) {
            Storage::disk('public')->delete($kendaraan->foto);
        }

        if (Storage::disk('public')->exists('qr_code/' . $kendaraan->id . '.png')) {
            Storage::disk('public')->delete('qr_code/' . $kendaraan->id . '.png');
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus.');
    }

    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('pages.admin.kendaraan.show', compact('kendaraan'));
    }
}
