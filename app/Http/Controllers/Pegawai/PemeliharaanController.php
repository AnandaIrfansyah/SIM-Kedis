<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeliharaanController extends Controller
{
    public function index()
    {
        $asn = Auth::user()->asn;

        if (!$asn) {
            return view('pages.pegawai.pemeliharaan.index', [
                'kepemilikanAktif' => null,
                'pemeliharaans'    => collect(),
            ]);
        }

        $kepemilikanAktif = $asn->kepemilikanKendaraans()
            ->whereNull('tanggal_selesai')
            ->with('kendaraan')
            ->first();

        $pemeliharaans = $kepemilikanAktif
            ? $kepemilikanAktif->kendaraan->pemeliharaans()
            ->where('asn_id', $asn->id)
            ->latest()
            ->get()
            : collect();

        return view('pages.pegawai.pemeliharaan.index', compact('kepemilikanAktif', 'pemeliharaans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pemeliharaan' => 'required|date',
            'jenis_pemeliharaan'   => 'required|string|max:255',
            'biaya'                => 'required|numeric|min:0',
            'bengkel'              => 'required|string|max:50',
            'keterangan'           => 'nullable|string|max:255',
        ]);

        $asn = Auth::user()->asn;

        if (!$asn) {
            return back()->with('error', 'Hanya ASN yang bisa menambahkan pemeliharaan.');
        }

        $kepemilikanAktif = $asn->kepemilikanKendaraans()->whereNull('tanggal_selesai')->first();

        if (!$kepemilikanAktif) {
            return back()->with('error', 'Anda belum memiliki kendaraan aktif.');
        }

        Pemeliharaan::create([
            'kendaraan_id'         => $kepemilikanAktif->kendaraan_id,
            'asn_id'               => $asn->id,
            'tanggal_pemeliharaan' => $request->tanggal_pemeliharaan,
            'jenis_pemeliharaan'   => $request->jenis_pemeliharaan,
            'biaya'                => $request->biaya,
            'bengkel'              => $request->bengkel,
            'keterangan'           => $request->keterangan,
        ]);

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Data pemeliharaan berhasil ditambahkan. Data tidak bisa diubah atau dihapus setelah disimpan.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('pemeliharaan.index')
            ->with('error', 'Data pemeliharaan tidak bisa diedit setelah disimpan.');
    }

    public function destroy($id)
    {
        return redirect()->route('pemeliharaan.index')
            ->with('error', 'Data pemeliharaan tidak bisa dihapus setelah disimpan.');
    }
}
