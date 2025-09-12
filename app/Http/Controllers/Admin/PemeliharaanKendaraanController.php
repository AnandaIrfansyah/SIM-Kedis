<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bengkel;
use App\Models\Kendaraan;
use App\Models\Pemeliharaan;
use Illuminate\Http\Request;

class PemeliharaanKendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('pemeliharaans')->paginate(10);
        return view('pages.admin.pemeliharaan.index', compact('kendaraans'));
    }

    public function show($kendaraanId)
    {
        $kendaraan = Kendaraan::with('pemeliharaans.bengkel')->findOrFail($kendaraanId);

        $groupedPemeliharaans = $kendaraan->pemeliharaans
            ->groupBy(function ($item) {
                return $item->nomor_nota . '|' .
                    $item->tanggal_pemeliharaan . '|' .
                    $item->kilometer . '|' .
                    ($item->bengkel_id ?? $item->nama_bengkel_manual);
            })
            ->map(function ($group) {
                $group->total_biaya = $group->sum('biaya');
                return $group;
            });

        return view('pages.admin.pemeliharaan.show', compact('kendaraan', 'groupedPemeliharaans'));
    }



    public function create($kendaraanId)
    {
        $kendaraan = Kendaraan::findOrFail($kendaraanId);
        $bengkels = Bengkel::all();
        return view('pages.admin.pemeliharaan.create', compact('kendaraan', 'bengkels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id'          => 'required|exists:kendaraans,id',
            'bengkel_id'            => 'nullable|exists:bengkels,id',
            'nama_bengkel_manual'   => 'nullable|string|max:255',
            'alamat_bengkel_manual' => 'nullable|string|max:255',
            'nomor_nota'            => 'nullable|string|max:255',
            'tanggal_pemeliharaan'  => 'required|date',
            'kilometer'             => 'nullable|integer',
            'uraian'                => 'nullable|string',
            'biaya'                 => 'nullable|numeric',
            'keterangan'            => 'nullable|string',
            'jenis_pemeliharaan'    => 'nullable|in:suku cadang,pelumas,servis',
        ]);

        Pemeliharaan::create($request->all());

        return redirect()->route('pemeliharaanKendaraan.index')->with('success', 'Pemeliharaan berhasil ditambahkan');
    }

    public function edit(Pemeliharaan $pemeliharaan)
    {
        $bengkels = Bengkel::all();
        return view('pages.admin.pemeliharaan.edit', compact('pemeliharaan', 'bengkels'));
    }

    public function update(Request $request, Pemeliharaan $pemeliharaan)
    {
        $request->validate([
            'bengkel_id'            => 'nullable|exists:bengkels,id',
            'nama_bengkel_manual'   => 'nullable|string|max:255',
            'alamat_bengkel_manual' => 'nullable|string|max:255',
            'nomor_nota'            => 'nullable|string|max:255',
            'tanggal_pemeliharaan'  => 'required|date',
            'kilometer'             => 'nullable|integer',
            'uraian'                => 'nullable|string',
            'biaya'                 => 'nullable|numeric',
            'keterangan'            => 'nullable|string',
            'jenis_pemeliharaan'    => 'nullable|in:suku cadang,pelumas,servis',
        ]);

        $pemeliharaan->update($request->all());

        return redirect()->route('pemeliharaanKendaraan.index')->with('success', 'Pemeliharaan berhasil diperbarui');
    }

    public function destroy(Pemeliharaan $pemeliharaan)
    {
        $pemeliharaan->delete();
        return redirect()->route('pemeliharaanKendaraan.index')->with('success', 'Pemeliharaan berhasil dihapus');
    }
}
