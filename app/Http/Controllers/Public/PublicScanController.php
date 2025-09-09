<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class PublicScanController extends Controller
{
    public function show($qrCode)
    {
        try {
            $kendaraan = Kendaraan::where('qr_code', $qrCode)->with('kepemilikanAktif.asn')->first();

            if (!$kendaraan) {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }

            return response()->json([
                'no_polisi'   => $kendaraan->no_polisi,
                'jenis'       => $kendaraan->jenis,
                'merk'        => $kendaraan->merk . ' / ' . $kendaraan->tipe,
                'tahun'       => $kendaraan->tahun,
                'no_rangka' => $kendaraan->no_rangka
                    ? substr($kendaraan->no_rangka, 0, 6) . '**********'
                    : '-',

                'no_mesin' => $kendaraan->no_mesin
                    ? substr($kendaraan->no_mesin, 0, 3) . '*******'
                    : '-',

                'no_bpkb' => $kendaraan->no_bpkb
                    ? substr($kendaraan->no_bpkb, 0, 2) . '*****' . substr($kendaraan->no_bpkb, -2)
                    : '-',
                'pemilik'     => $kendaraan->kepemilikanAktif && $kendaraan->kepemilikanAktif->asn
                    ? $kendaraan->kepemilikanAktif->asn->nama
                    : 'Telah Berakhir',
                'unit_kerja'  => $kendaraan->kepemilikanAktif && $kendaraan->kepemilikanAktif->asn
                    ? $kendaraan->kepemilikanAktif->asn->jabatan
                    : 'Telah Berakhir',
                'foto'        => $kendaraan->foto ? asset('storage/' . $kendaraan->foto) : null,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }
}
