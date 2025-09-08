@extends('layouts.admin')

@section('title', 'Data Kendaraan')

@push('style    ')
    <style>
        .preview-img-limited {
            max-height: 80vh;
            max-width: 90vw;
            object-fit: contain;
        }
    </style>
@endpush

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
                                            <td>{{ $item->no_polisi }}</td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
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
                                    @endforeach
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
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </td>
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
                                            <img src="{{ asset('storage/qr_code/' . $item->id . '.png') }}" alt="QR Code"
                                                class="img-fluid mb-3 preview-media" width="150"
                                                data-src="{{ asset('storage/qr_code/' . $item->id . '.png') }}">
                                        @else
                                            <span class="text-muted">Belum ada QR Code</span>
                                        @endif

                                        <h6 class="text-primary mb-2"><i class="fas fa-image"></i> Foto Kendaraan</h6>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Kendaraan"
                                                class="img-thumbnail preview-media" width="200"
                                                data-src="{{ asset('storage/' . $item->foto) }}">
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

    <div class="modal fade" id="mediaPreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-transparent border-0 shadow-none text-center">
                <button type="button" class="close text-white ml-auto mr-2 mt-2" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img id="mediaPreviewImg" src="" class="img-fluid rounded preview-img-limited" alt="Preview">
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
            const previewMedia = document.querySelectorAll('.preview-media');
            const previewModal = document.getElementById('mediaPreviewModal');
            const previewImg = document.getElementById('mediaPreviewImg');

            previewMedia.forEach(el => {
                el.addEventListener('click', function() {
                    const src = this.getAttribute('data-src');
                    previewImg.setAttribute('src', src);
                    $('#mediaPreviewModal').modal('show');
                });
            });
        });
    </script>
@endpush
