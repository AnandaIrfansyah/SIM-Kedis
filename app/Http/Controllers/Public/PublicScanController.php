<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class PublicScanController extends Controller
{
    // --- API JSON untuk dashboard ---
    public function scanApi($qrCode)
    {
        $kendaraan = Kendaraan::with('kepemilikanAktif.asn')
            ->where('qr_code', $qrCode)
            ->first();

        if (!$kendaraan) {
            return response()->json(['error' => 'Data kendaraan tidak ditemukan'], 404);
        }

        $mask = fn($v) => $v ? substr($v, 0, 3) . str_repeat('*', max(strlen($v) - 3, 0)) : null;

        return response()->json([
            'foto'       => $kendaraan->foto ? asset('storage/' . $kendaraan->foto) : null,
            'no_polisi'  => $kendaraan->no_polisi,
            'jenis'      => $kendaraan->jenis,
            'merk'       => $kendaraan->merk . ' / ' . $kendaraan->tipe,
            'tahun'      => $kendaraan->tahun,
            'no_rangka'  => $mask($kendaraan->no_rangka),
            'no_mesin'   => $mask($kendaraan->no_mesin),
            'no_bpkb'    => $mask($kendaraan->no_bpkb),
            'pemilik'    => optional(optional($kendaraan->kepemilikanAktif)->asn)->nama ?? 'Telah Berakhir',
            'unit_kerja' => optional(optional($kendaraan->kepemilikanAktif)->asn)->jabatan ?? 'Telah Berakhir',
        ]);
    }

    // --- View untuk Google Lens / link QR ---
    public function scanView($qrCode)
    {
        $kendaraan = Kendaraan::with('kepemilikanAktif.asn')
            ->where('qr_code', $qrCode)
            ->first();

        $mask = fn($v) => $v ? substr($v, 0, 3) . str_repeat('*', max(strlen($v) - 3, 0)) : null;

        $data = null;
        if ($kendaraan) {
            $data = [
                'foto'       => $kendaraan->foto ? asset('storage/' . $kendaraan->foto) : null,
                'no_polisi'  => $kendaraan->no_polisi,
                'jenis'      => $kendaraan->jenis,
                'merk'       => $kendaraan->merk . ' / ' . $kendaraan->tipe,
                'tahun'      => $kendaraan->tahun,
                'no_rangka'  => $mask($kendaraan->no_rangka),
                'no_mesin'   => $mask($kendaraan->no_mesin),
                'no_bpkb'    => $mask($kendaraan->no_bpkb),
                'pemilik'    => optional(optional($kendaraan->kepemilikanAktif)->asn)->nama ?? 'Telah Berakhir',
                'unit_kerja' => optional(optional($kendaraan->kepemilikanAktif)->asn)->jabatan ?? 'Telah Berakhir',
            ];
        }

        return view('pages.public.scan-result', compact('data'));
    }
}
