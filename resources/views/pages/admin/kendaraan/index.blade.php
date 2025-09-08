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
                                        <th class="text-center text-white">QR Code</th>
                                        <th class="text-center text-white">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kendaraan as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->merk ?? '-' }}</td>
                                            <td>{{ $item->tipe ?? '-' }}</td>
                                            <td>{{ $item->no_polisi ?? '-' }}</td>
                                            <td>{{ $item->tahun ?? '-' }}</td>
                                            <td>{{ ucfirst($item->status ?? '-') }}</td>
                                            <td>
                                                @if ($item->qr_code)
                                                    <img src="{{ asset('storage/qr_code/' . $item->id . '.png') }}"
                                                        alt="QR" width="50">
                                                @else
                                                    <span class="text-muted">Belum ada QR</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Tombol Show -->
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#showModal{{ $item->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <!-- Tombol Edit -->
                                                <a href="{{ route('kendaraan.edit', $item->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Tombol Delete -->
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
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">
                                                <em>Data kendaraan belum tersedia</em>
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

    @foreach ($kendaraan as $item)
        <div class="modal fade" id="showModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="showModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="showModalLabel{{ $item->id }}">Detail Kendaraan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if ($item)
                            <div class="row">
                                <!-- Kolom kiri -->
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Merk</th>
                                            <td>{{ $item->merk ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tipe</th>
                                            <td>{{ $item->tipe ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Polisi</th>
                                            <td>{{ $item->no_polisi ?? '-' }}</td>
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
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($item->status ?? '-') }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Kolom kanan -->
                                <div class="col-md-6 text-center">
                                    <div class="mb-3">
                                        <strong>QR Code</strong><br>
                                        @if ($item->qr_code)
                                            <img src="{{ asset('storage/qr_code/' . $item->id . '.png') }}" alt="QR Code"
                                                class="img-fluid" width="150">
                                        @else
                                            <span class="text-muted">Belum ada QR Code</span>
                                        @endif
                                    </div>

                                    <div>
                                        <strong>Foto Kendaraan</strong><br>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Kendaraan"
                                                class="img-thumbnail mt-2" width="200">
                                        @else
                                            <span class="text-muted">Belum ada foto</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center text-muted">Data kendaraan tidak tersedia.</p>
                        @endif
                    </div>

                    <div class="modal-footer">
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
@endpush
