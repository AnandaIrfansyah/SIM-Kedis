@extends('layouts.admin')

@section('title', 'Detail Pemeliharaan Kendaraan')

@push('style')
    <style>
        .section-title {
            font-size: 1.1rem;
            color: #6777ef;
            border-bottom: 2px solid #6777ef;
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        .info-item {
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background-color: #f8f9fa;
            padding-left: 10px;
            padding-right: 10px;
            margin-left: -10px;
            margin-right: -10px;
            border-radius: 5px;
        }

        .info-label {
            flex: 1;
        }

        .info-value {
            flex: 1;
        }

        .border-right {
            border-right: 1px solid #e3e6f0 !important;
        }

        @media (max-width: 767.98px) {
            .border-right {
                border-right: none !important;
                border-bottom: 1px solid #e3e6f0 !important;
                padding-bottom: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Detail Pemeliharaan Kendaraan</h1>
                <a href="{{route('pemeliharaanKendaraan.index')}}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

            </div>

            <div class="section-body">
                <div class="card card-primary mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-car mr-2"></i>Detail Kendaraan</h4>
                        <div class="card-header-action">
                            <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                class="btn btn-icon icon-left btn-light">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Kolom Informasi Utama -->
                            <div class="col-md-6 border-right">
                                <h5 class="section-title mb-4">Informasi Utama</h5>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">Merk / Tipe</div>
                                    <div class="info-value text-right">{{ $kendaraan->merk }} {{ $kendaraan->tipe }}</div>
                                </div>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">No Polisi</div>
                                    <div class="info-value text-right badge badge-primary badge-pill py-2 px-3">
                                        {{ $kendaraan->no_polisi }}</div>
                                </div>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">Tahun</div>
                                    <div class="info-value text-right">{{ $kendaraan->tahun ?? '-' }}</div>
                                </div>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">Jenis</div>
                                    <div class="info-value text-right">{{ $kendaraan->jenis ?? '-' }}</div>
                                </div>

                                <div class="info-item d-flex justify-content-between align-items-center">
                                    <div class="info-label font-weight-bold">Status</div>
                                    <div class="info-value">
                                        <span
                                            class="badge badge-{{ $kendaraan->status == 'aktif' ? 'success' : 'danger' }} py-2 px-3">
                                            {{ ucfirst($kendaraan->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Informasi Teknis & Administrasi -->
                            <div class="col-md-6">
                                <h5 class="section-title mb-4">Informasi Teknis & Administrasi</h5>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">No Rangka</div>
                                    <div class="info-value text-right text-monospace">{{ $kendaraan->no_rangka ?? '-' }}
                                    </div>
                                </div>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">No Mesin</div>
                                    <div class="info-value text-right text-monospace">{{ $kendaraan->no_mesin ?? '-' }}
                                    </div>
                                </div>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">No BPKB</div>
                                    <div class="info-value text-right">{{ $kendaraan->no_bpkb ?? '-' }}</div>
                                </div>

                                <div
                                    class="info-item d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="info-label font-weight-bold">Jatuh Tempo Pajak</div>
                                    <div
                                        class="info-value text-right {{ $kendaraan->jatuh_tempo_pajak && \Carbon\Carbon::parse($kendaraan->jatuh_tempo_pajak)->isPast() ? 'text-danger' : '' }}">
                                        {{ $kendaraan->jatuh_tempo_pajak ? \Carbon\Carbon::parse($kendaraan->jatuh_tempo_pajak)->translatedFormat('d F Y') : '-' }}
                                    </div>
                                </div>

                                <div class="info-item d-flex justify-content-between align-items-center">
                                    <div class="info-label font-weight-bold">Jatuh Tempo STNK</div>
                                    <div
                                        class="info-value text-right {{ $kendaraan->jatuh_tempo_stnk && \Carbon\Carbon::parse($kendaraan->jatuh_tempo_stnk)->isPast() ? 'text-danger' : '' }}">
                                        {{ $kendaraan->jatuh_tempo_stnk ? \Carbon\Carbon::parse($kendaraan->jatuh_tempo_stnk)->translatedFormat('d F Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4><i class="fas fa-history"></i> Riwayat Pemeliharaan</h4>
                        <div class="card-header-action">
                            <a href="{{ route('pemeliharaanKendaraan.create', $kendaraan->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pemeliharaan
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table-pemeliharaan">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-white">No</th>
                                        <th class="text-center text-white">No. Nota</th>
                                        <th class="text-center text-white">Tanggal</th>
                                        <th class="text-center text-white">Bengkel</th>
                                        <th class="text-center text-white">Uraian</th>
                                        <th class="text-center text-white">Jenis</th>
                                        <th class="text-center text-white">Biaya</th>
                                        <th class="text-center text-white">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalBiaya = 0; @endphp
                                    @forelse ($groupedPemeliharaans as $index => $group)
                                        @php
                                            $rowspan = $group->count();
                                            $first = $group->first();
                                            $groupTotal = $group->sum('biaya');
                                            $totalBiaya += $groupTotal;
                                        @endphp

                                        @foreach ($group as $i => $pemeliharaan)
                                            <tr>
                                                @if ($i == 0)
                                                    <td class="text-center align-middle" rowspan="{{ $rowspan }}">
                                                        {{ $loop->parent->iteration }}
                                                    </td>
                                                    <td class="text-center align-middle" rowspan="{{ $rowspan }}">
                                                        {{ $first->nomor_nota ?? '-' }}
                                                    </td>
                                                    <td class="text-center align-middle" rowspan="{{ $rowspan }}">
                                                        {{ \Carbon\Carbon::parse($first->tanggal_pemeliharaan)->translatedFormat('d F Y') }}
                                                    </td>
                                                    <td class="align-middle" rowspan="{{ $rowspan }}">
                                                        @if ($first->bengkel)
                                                            <strong>{{ $first->bengkel->nama }}</strong><br>
                                                        @else
                                                            <strong>{{ $first->nama_bengkel_manual }}</strong><br>
                                                        @endif
                                                    </td>
                                                @endif

                                                <td>{{ $pemeliharaan->uraian ?? '-' }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge badge-{{ $pemeliharaan->jenis_pemeliharaan == 'rutin' ? 'info' : 'warning' }}">
                                                        {{ ucfirst($pemeliharaan->jenis_pemeliharaan) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    Rp {{ number_format($pemeliharaan->biaya, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('pemeliharaanKendaraan.edit', $pemeliharaan->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('pemeliharaanKendaraan.destroy', $pemeliharaan->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <i class="fas fa-info-circle mr-2"></i>Belum ada data pemeliharaan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if (count($groupedPemeliharaans) > 0)
                                    <tfoot class="bg-light">
                                        <tr>
                                            <th colspan="6" class="text-right">Total Biaya Pemeliharaan:</th>
                                            <th class="text-center">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('[title]').tooltip();
        });
    </script>
@endpush
