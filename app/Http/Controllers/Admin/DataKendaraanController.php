<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validate([
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'no_polisi' => 'required|string|max:50|unique:kendaraans',
            'no_rangka' => 'nullable|string|max:100',
            'no_mesin' => 'nullable|string|max:100',
            'tahun' => 'required|integer',
            'jenis' => 'nullable|string|max:50',
            'jatuh_tempo_pajak' => 'nullable|date',
            'jatuh_tempo_stnk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|string|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        }

        Kendaraan::create($data);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('pages.admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $data = $request->validate([
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'no_polisi' => 'required|string|max:50|unique:kendaraans,no_polisi,' . $kendaraan->id,
            'no_rangka' => 'nullable|string|max:100',
            'no_mesin' => 'nullable|string|max:100',
            'tahun' => 'required|integer',
            'jenis' => 'nullable|string|max:50',
            'jatuh_tempo_pajak' => 'nullable|date',
            'jatuh_tempo_stnk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|string|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto')) {
            if ($kendaraan->foto) {
                Storage::disk('public')->delete($kendaraan->foto);
            }
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        }

        $kendaraan->update($data);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diupdate!');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        if ($kendaraan->foto) {
            Storage::disk('public')->delete($kendaraan->foto);
        }
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus!');
    }
}
