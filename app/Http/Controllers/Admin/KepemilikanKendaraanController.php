<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asn;
use App\Models\Kendaraan;
use App\Models\KepemilikanKendaraan;
use Illuminate\Http\Request;

class KepemilikanKendaraanController extends Controller
{
    public function index()
    {
        $kepemilikans = KepemilikanKendaraan::with(['asn.user', 'kendaraan'])->latest()->get();
        return view('pages.admin.kepemilkan.index', compact('kepemilikans'));
    }

    public function create()
    {
        $asns = Asn::with('user')->where('status', 'aktif')->get();

        $kendaraans = Kendaraan::doesntHave('currentKepemilikan')->get();

        return view('pages.admin.kepemilkan.create', compact('asns', 'kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asn_id' => 'required|exists:asns,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
        ]);

        KepemilikanKendaraan::create([
            'asn_id' => $request->asn_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_mulai' => now(),
            'status' => 'aktif',
        ]);

        return redirect()->route('kepemilikan.index')->with('success', 'Kepemilikan kendaraan berhasil ditambahkan.');
    }

    public function selesai($id)
    {
        $kepemilikan = KepemilikanKendaraan::findOrFail($id);

        $kepemilikan->update([
            'tanggal_selesai' => now(),
            'status' => 'nonaktif', 
        ]);

        return redirect()->back()->with('success', 'Kepemilikan kendaraan telah diselesaikan.');
    }
}
