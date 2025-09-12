@extends('layouts.admin')

@section('title', 'Data Kendaraan Nonaktif')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Data Kendaraan Nonaktif</h1>
                <a href="{{ route('kendaraan.index') }}" class="btn btn-primary" title="Kembali ke Kendaraan Aktif">
                    <i class="fas fa-arrow-left"></i> Kembali ke Kendaraan Aktif
                </a>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <!-- Form Search -->
                        <div class="float-right mb-3">
                            <form method="GET" action="{{ route('kendaraan.inactive') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari Merk / No Polisi"
                                        name="search" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" title="Cari Kendaraan">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-white">No</th>
                                        <th class="text-center text-white">Merk</th>
                                        <th class="text-center text-white">No Polisi</th>
                                        <th class="text-center text-white">Tahun</th>
                                        <th class="text-center text-white">Status</th>
                                        <th class="text-center text-white">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kendaraan as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->merk }}</td>
                                            <td>{{ $item->no_polisi }}</td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-sm dropdown-toggle
                                                        {{ $item->status == 'aktif' ? 'btn-success' : 'btn-danger' }}"
                                                        type="button" id="dropdownMenuButton{{ $item->id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($item->status) }}
                                                    </button>
                                                    <div class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton{{ $item->id }}">
                                                        <form action="{{ route('kendaraan.update-status', $item->id) }}"
                                                            method="POST" class="form-update-status d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="aktif">
                                                            <button type="submit" class="dropdown-item">Aktif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <!-- Tombol Detail -->
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#showModal{{ $item->id }}"
                                                    title="Lihat Detail Kendaraan">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <!-- Tombol Delete -->
                                                <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST"
                                                    class="form-delete d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        title="Hapus Kendaraan">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                Tidak ada data kendaraan nonaktif.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Detail -->
    @foreach ($kendaraan as $item)
        <div class="modal fade" id="showModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="showModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="showModalLabel{{ $item->id }}">
                            <i class="fas fa-car mr-2 mb-3"></i> Detail Kendaraan
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        <h6 class="text-primary mb-3"><i class="fas fa-info-circle"></i> Informasi Kendaraan
                                        </h6>
                                        <table class="table table-sm table-borderless mb-0">
                                            <tr>
                                                <th width="40%">Merk</th>
                                                <td>{{ $item->merk }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipe</th>
                                                <td>{{ $item->tipe }}</td>
                                            </tr>
                                            <tr>
                                                <th>No Polisi</th>
                                                <td>{{ $item->no_polisi }}</td>
                                            </tr>
                                            <tr>
                                                <th>No Rangka</th>
                                                <td>{{ $item->no_rangka ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>No Mesin</th>
                                                <td>{{ $item->no_mesin ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tahun</th>
                                                <td>{{ $item->tahun ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><span class="badge badge-danger">Nonaktif</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="text-primary mb-3"><i class="fas fa-qrcode"></i> QR Code</h6>
                                        @if ($item->qr_code)
                                            <img src="{{ asset('storage/qr_code/' . $item->qr_code . '.png') }}"
                                                alt="QR Code" class="img-fluid mb-3" width="150">
                                        @else
                                            <span class="text-muted">Belum ada QR Code</span>
                                        @endif

                                        <h6 class="text-primary mb-2"><i class="fas fa-image"></i> Foto Kendaraan</h6>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Kendaraan"
                                                class="img-thumbnail" width="200">
                                        @else
                                            <span class="text-muted">Belum ada foto</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Tutup
                        </button>
                        <a href="{{ route('kendaraan.edit', $item->id) }}" class="btn btn-info">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.form-delete');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data tidak bisa dikembalikan setelah dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusForms = document.querySelectorAll('.form-update-status');

            statusForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // stop submit dulu

                    Swal.fire({
                        title: 'Ubah Status Pegawai?',
                        text: "Status pegawai akan diperbarui.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, ubah!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // submit kalau user setuju
                        }
                    });
                });
            });
        });
    </script>
@endpush
