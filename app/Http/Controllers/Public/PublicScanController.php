<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class PublicScanController extends Controller
{
    public function scanqr($qrCode)
    {
        try {
            $kendaraan = Kendaraan::with('kepemilikanAktif.asn')
                ->where('qr_code', $qrCode)
                ->firstOrFail();

            // fungsi untuk masking data sensitif
            $mask = function ($value) {
                if (!$value) return null;
                $len = strlen($value);
                if ($len <= 3) return $value; 
                return substr($value, 0, 3) . str_repeat('*', $len - 3);
            };

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
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Data kendaraan tidak ditemukan'], 404);
        } catch (\Exception $e) {
            // biar kelihatan jelas errornya saat debugging
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
