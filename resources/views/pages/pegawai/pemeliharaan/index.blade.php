@extends('layouts.pegawai')

@section('title', 'Pemeliharaan Kendaraan')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Pemeliharaan Kendaraan</h1>
                @if ($kepemilikanAktif)
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createPemeliharaanModal">
                        <i class="fas fa-plus"></i> Tambah Pemeliharaan
                    </button>
                @endif
            </div>

            <div class="section-body">
                @if ($kepemilikanAktif)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5>Detail Kendaraan Aktif</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    @if ($kepemilikanAktif->kendaraan->foto)
                                        <img src="{{ asset('storage/' . $kepemilikanAktif->kendaraan->foto) }}"
                                            alt="Foto Kendaraan" class="img-fluid rounded shadow-sm"
                                            style="max-height: 200px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada foto kendaraan</span>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-sm ">
                                        <tr>
                                            <th>Merk / Tipe</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->merk }} /
                                                {{ $kepemilikanAktif->kendaraan->tipe }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Polisi</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->no_polisi }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Rangka</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->no_rangka ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Mesin</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->no_mesin ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->tahun }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->jenis ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jatuh Tempo Pajak</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->jatuh_tempo_pajak ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jatuh Tempo STNK</th>
                                            <td>{{ $kepemilikanAktif->kendaraan->jatuh_tempo_stnk ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $kepemilikanAktif->kendaraan->status == 'aktif' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($kepemilikanAktif->kendaraan->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 📌 RIWAYAT PEMELIHARAAN -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-black">
                            <h5>Riwayat Pemeliharaan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary text-center">
                                        <tr>
                                            <th class="text-white">No</th>
                                            <th class="text-white">Tanggal</th>
                                            <th class="text-white">Jenis Pemeliharaan</th>
                                            <th class="text-white">Biaya</th>
                                            <th class="text-white">Bengkel</th>
                                            <th class="text-white">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pemeliharaans as $pem)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $pem->tanggal_pemeliharaan ?? '-' }}</td>
                                                <td>{!! $pem->jenis_pemeliharaan ?? '-' !!}</td>
                                                <td>Rp {{ number_format($pem->biaya, 0, ',', '.') ?? '-' }}</td>
                                                <td>{{ $pem->bengkel ?? '-' }}</td>
                                                <td>{!! $pem->keterangan ?? '-' !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    <em>Belum ada data pemeliharaan</em>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        Anda belum memiliki kendaraan aktif.
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

<!-- 📌 Modal Tambah -->
@if ($kepemilikanAktif)
    <div class="modal fade" id="createPemeliharaanModal"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('pemeliharaan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Pemeliharaan</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal_pemeliharaan" class="form-control"
                                    placeholder="Masukkan tanggal pemeliharaan" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Biaya</label>
                                <input type="string" name="biaya" class="form-control"
                                    placeholder="Masukkan biaya pemeliharaan" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Bengkel</label>
                                <input type="text" name="bengkel" class="form-control"
                                    placeholder="Masukkan nama bengkel" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jenis Pemeliharaan</label>
                                <textarea name="jenis_pemeliharaan" class="form-control summernote-simple" rows="2"
                                    placeholder="Masukkan jenis pemeliharaan" required></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control summernote-simple" rows="2"
                                    placeholder="Masukkan keterangan pemeliharaan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 📌 Modal Edit -->
    @foreach ($pemeliharaans as $pem)
        <div class="modal fade" id="editPemeliharaanModal{{ $pem->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('pemeliharaan.update', $pem->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">Edit Pemeliharaan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal_pemeliharaan" class="form-control"
                                        value="{{ $pem->tanggal_pemeliharaan }}"
                                        placeholder="Masukkan tanggal pemeliharaan" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Biaya</label>
                                    <input type="string" name="biaya" class="form-control"
                                        value="{{ $pem->biaya }}" placeholder="Masukkan biaya pemeliharaan"
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Bengkel</label>
                                    <input type="text" name="bengkel" class="form-control"
                                        value="{{ $pem->bengkel }}" placeholder="Masukkan nama bengkel" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Jenis Pemeliharaan</label>
                                    <textarea name="jenis_pemeliharaan" class="form-control summernote-simple" rows="2"
                                        placeholder="Masukkan jenis pemeliharaan" required>{{ $pem->jenis_pemeliharaan }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control summernote-simple" rows="2"
                                        placeholder="Masukkan keterangan pemeliharaan">{{ $pem->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

@push('scripts')
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
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
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Summernote dengan placeholder
            $('.summernote-simple').summernote({
                placeholder: 'Masukkan teks di sini...',
                height: 100, // Tinggi editor
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });

            // Konfirmasi Tambah Data
            const formTambah = document.getElementById('createPemeliharaanModal');
            if (formTambah) {
                formTambah.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Simpan Data?',
                        text: "Data pemeliharaan tidak bisa diedit atau dihapus setelah disimpan.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formTambah.submit();
                        }
                    });
                });
            }
        });
    </script>
@endpush
