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
        $asns = Asn::whereDoesntHave('kepemilikanKendaraans', function ($q) {
            $q->where('status', 'aktif');
        })->get();

        $kendaraans = Kendaraan::whereDoesntHave('kepemilikanKendaraans', function ($q) {
            $q->where('status', 'aktif');
        })->get();

        return view('pages.admin.kepemilkan.create', compact('asns', 'kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asn_id' => 'required|exists:asns,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
        ]);

        $kendaraanAktif = KepemilikanKendaraan::where('kendaraan_id', $request->kendaraan_id)
            ->where('status', 'aktif')
            ->exists();

        if ($kendaraanAktif) {
            return redirect()->back()->withErrors([
                'kendaraan_id' => 'Kendaraan ini masih dimiliki ASN lain.',
            ]);
        }

        $asnAktif = KepemilikanKendaraan::where('asn_id', $request->asn_id)
            ->where('status', 'aktif')
            ->exists();

        if ($asnAktif) {
            return redirect()->back()->withErrors([
                'asn_id' => 'ASN ini masih memiliki kendaraan aktif.',
            ]);
        }

        KepemilikanKendaraan::create([
            'asn_id' => $request->asn_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_mulai' => now(),
            'status' => 'aktif',
        ]);

        return redirect()->route('kepemilikan.index')
            ->with('success', 'Kepemilikan kendaraan berhasil ditambahkan.');
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
