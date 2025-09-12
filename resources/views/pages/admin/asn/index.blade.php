@extends('layouts.admin')

@section('title', 'Data Pegawai')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Data Pegawai</h1>
                <a href="{{ route('asn.create') }}" class="btn btn-primary" title="Tambah Data Pegawai">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <!-- Tombol Tambah Data di kiri -->
                            <a href="{{ route('asn.inactive') }}" class="btn btn-danger"
                                title="Riwayat Pegawai Tidak Aktif">
                                <i class="fas fa-history"></i> Riwayat Pegawai Tidak Aktif
                            </a>

                            <!-- Form pencarian di kanan -->
                            <form method="GET" action="{{ route('asn.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari Nama" name="name"
                                        value="{{ request('name') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" title="Cari Pegawai">
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
                                        <th class="text-center text-white">Nama</th>
                                        <th class="text-center text-white">NIP</th>
                                        <th class="text-center text-white">Nomor HP</th>
                                        <th class="text-center text-white">Jabatan</th>
                                        <th class="text-center text-white">Status</th>
                                        <th class="text-center text-white">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($asn as $item)
                                        <tr class="text-center">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->nip }}</td>
                                            <td>{{ $item->no_hp ?? '-' }}</td>
                                            <td>{{ $item->jabatan ?? '-' }}</td>
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
                                                        <form action="{{ route('asn.update-status', $item->id) }}"
                                                            method="POST" class="form-update-status d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="nonaktif">
                                                            <button type="submit" class="dropdown-item">Nonaktif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('asn.edit', $item->id) }}" class="btn btn-sm btn-info"
                                                    title="Edit Data Pegawai">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('asn.destroy', $item->id) }}" method="POST"
                                                    class="form-delete d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        title="Hapus Data Pegawai">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                Data pegawai tidak tersedia.
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
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>

    <!-- Page Specific JS File -->
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
                    e.preventDefault(); // stop submit dulu
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data pegawai tidak bisa dikembalikan setelah dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // submit form yang benar
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
