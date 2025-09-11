@extends('layouts.admin')

@section('title', 'Data Kepemilikan Kendaraan')

@push('style')
    <style>
        .card-header h6 {
            font-size: 1.1rem;
        }

        label {
            font-size: 0.85rem;
        }

        p {
            font-size: 0.95rem;
        }

        .card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.5rem;
        }

        .img-thumbnail {
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.03);
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Data Kepemilikan Kendaraan</h1>
                <a href="{{ route('kepemilikan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kepemilikan
                </a>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('kepemilikan.inactive') }}" class="btn btn-danger">
                                <i class="fas fa-archive"></i> Riwayat Kepemilikan Selesai
                            </a>
                            <div class="mb-3">
                                <form method="GET" action="{{ route('kepemilikan.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari ASN / Merk / No Polisi"
                                            name="search" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-white">No</th>
                                        <th class="text-center text-white">ASN</th>
                                        <th class="text-center text-white">Kendaraan</th>
                                        <th class="text-center text-white">No Polisi</th>
                                        <th class="text-center text-white">Tanggal Mulai</th>
                                        <th class="text-center text-white">Tanggal Selesai</th>
                                        <th class="text-center text-white">Status</th>
                                        <th class="text-center text-white">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kepemilikans as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->asn->user->name }}</td>
                                            <td>{{ $item->kendaraan->merk }} {{ $item->kendaraan->tipe }}</td>
                                            <td>{{ $item->kendaraan->no_polisi }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                                            <td>
                                                {{ optional($item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai) : null)?->translatedFormat(
                                                    'd F Y',
                                                ) ?? '-' }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info mr-1" data-toggle="modal"
                                                    data-target="#detailModal{{ $item->id }}">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>

                                                @if ($item->status == 'aktif')
                                                    <form action="{{ route('kepemilikan.selesai', $item->id) }}"
                                                        method="POST" class="d-inline-block form-finish">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="btn btn-sm btn-warning btn-finish">
                                                            <i class="fas fa-check"></i> Selesai
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @foreach ($kepemilikans as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">
                            <i class="fas fa-car mr-2 mb-3"></i>Detail Kepemilikan Kendaraan
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <!-- Detail ASN -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-primary text-white d-flex align-items-center">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        <h6 class="mb-0">Detail ASN</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <label class="font-weight-bold text-primary mb-0">Nama</label>
                                                <p class="mb-0">{{ $item->asn->user->name }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-primary mb-0">NIP</label>
                                                <p class="mb-0">{{ $item->asn->nip }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-primary mb-0">Jabatan</label>
                                                <p class="mb-0">{{ $item->asn->jabatan ?? '-' }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-primary mb-0">Unit Kerja</label>
                                                <p class="mb-0">{{ $item->asn->unit_kerja ?? '-' }}</p>
                                            </div>
                                            {{-- <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-primary mb-0">No HP</label>
                                                <p class="mb-0">{{ $item->asn->no_hp ?? '-' }}</p>
                                            </div> --}}
                                            <div class="col-6 mb-2">
                                                <label class="font-weight-bold text-primary mb-0">Status</label>
                                                <p class="mb-0">
                                                    <span
                                                        class="badge badge-pill {{ $item->asn->status == 'aktif' ? 'badge-success' : ($item->asn->status == 'pensiun' ? 'badge-secondary' : 'badge-danger') }}">
                                                        {{ ucfirst($item->asn->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Kendaraan -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-info text-white d-flex align-items-center">
                                        <i class="fas fa-car mr-2"></i>
                                        <h6 class="mb-0">Detail Kendaraan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">Merk</label>
                                                <p class="mb-0">{{ $item->kendaraan->merk }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">Tipe</label>
                                                <p class="mb-0">{{ $item->kendaraan->tipe ?? '-' }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">No Polisi</label>
                                                <p class="mb-0">{{ $item->kendaraan->no_polisi }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">Tahun</label>
                                                <p class="mb-0">{{ $item->kendaraan->tahun ?? '-' }}</p>
                                            </div>
                                            {{-- <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">No Rangka</label>
                                                <p class="mb-0">{{ $item->kendaraan->no_rangka ?? '-' }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">No Mesin</label>
                                                <p class="mb-0">{{ $item->kendaraan->no_mesin ?? '-' }}</p>
                                            </div> --}}
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">Jenis</label>
                                                <p class="mb-0">{{ ucfirst($item->kendaraan->jenis) }}</p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">Status</label>
                                                <p class="mb-0">
                                                    <span
                                                        class="badge badge-pill {{ $item->kendaraan->status == 'aktif' ? 'badge-success' : 'badge-secondary' }}">
                                                        {{ ucfirst($item->kendaraan->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">Jatuh Tempo Pajak</label>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($item->kendaraan->jatuh_tempo_pajak)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label class="font-weight-bold text-info mb-0">Jatuh Tempo STNK</label>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($item->kendaraan->jatuh_tempo_stnk)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Foto & QR Code -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-secondary text-white d-flex align-items-center">
                                        <i class="fas fa-images mr-2"></i>
                                        <h6 class="mb-0">Foto & QR Code</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col-md-6 mb-3 mb-md-0">
                                                <h6 class="text-primary mb-3">
                                                    <i class="fas fa-camera mr-2"></i>Foto Kendaraan
                                                </h6>
                                                @if ($item->kendaraan->foto)
                                                    <img src="{{ asset('storage/' . $item->kendaraan->foto) }}"
                                                        alt="Foto Kendaraan" class="img-thumbnail preview-media"
                                                        style="max-height: 200px; cursor: pointer;"
                                                        data-src="{{ asset('storage/' . $item->kendaraan->foto) }}"
                                                        data-toggle="tooltip" title="Klik untuk memperbesar">
                                                @else
                                                    <div class="bg-light p-5 rounded">
                                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                                        <p class="text-muted mb-0">Belum ada foto kendaraan</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-info mb-3">
                                                    <i class="fas fa-qrcode mr-2"></i>QR Code
                                                </h6>
                                                @if ($item->kendaraan->qr_code)
                                                    <img src="{{ asset('storage/qr_code/' . $item->kendaraan->id . '.png') }}"
                                                        alt="QR Code" class="img-thumbnail preview-media"
                                                        style="max-height: 200px; cursor: pointer;"
                                                        data-src="{{ asset('storage/qr_code/' . $item->kendaraan->id . '.png') }}"
                                                        data-toggle="tooltip" title="Klik untuk memperbesar">
                                                @else
                                                    <div class="bg-light p-5 rounded">
                                                        <i class="fas fa-qrcode fa-3x text-muted mb-2"></i>
                                                        <p class="text-muted mb-0">Belum ada QR Code</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal untuk preview gambar -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="previewImage" src="" alt="Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
    <script>
        // Script untuk preview gambar
        $(document).ready(function() {
            $('.preview-media').click(function() {
                var src = $(this).data('src');
                $('#previewImage').attr('src', src);
                $('#imagePreviewModal').modal('show');
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).on('click', '.btn-finish', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Kepemilikan kendaraan ini akan diselesaikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesai!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
