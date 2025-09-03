@extends('layouts.admin')

@section('title', 'Data Kendaraan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Data Kendaraan</h1>
                <a href="{{ route('kendaraan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kendaraan
                </a>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-white">No</th>
                                        <th class="text-center text-white">Merk</th>
                                        <th class="text-center text-white">Tipe</th>
                                        <th class="text-center text-white">No Polisi</th>
                                        <th class="text-center text-white">Tahun</th>
                                        <th class="text-center text-white">Status</th>
                                        <th class="text-center text-white">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kendaraan as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->merk }}</td>
                                            <td>{{ $item->tipe }}</td>
                                            <td>{{ $item->no_polisi }}</td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>{{ ucfirst($item->status) }}</td>
                                            <td>
                                                <a href="{{ route('kendaraan.edit', $item->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST"
                                                    class="form-delete d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
@endpush
