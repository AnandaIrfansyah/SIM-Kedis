@extends('layouts.admin')

@section('title', 'Edit Pegawai')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Pegawai</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Form Edit Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asn.update', $asn->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Kolom kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" id="nip" name="nip" class="form-control"
                                            value="{{ old('nip', $asn->nip) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ old('name', $asn->user->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ old('email', $asn->user->email) }}" required>
                                    </div>
                                </div>

                                <!-- Kolom kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" id="jabatan" name="jabatan" class="form-control"
                                            value="{{ old('jabatan', $asn->jabatan) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="unit_kerja">Unit Kerja</label>
                                        <input type="text" id="unit_kerja" name="unit_kerja" class="form-control"
                                            value="{{ old('unit_kerja', $asn->unit_kerja) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="no_hp">No HP</label>
                                        <input type="text" id="no_hp" name="no_hp" class="form-control"
                                            value="{{ old('no_hp', $asn->no_hp) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Status ASN</label>
                                <select id="status" name="status" class="form-control selectric" required>
                                    <option value="">-- Pilih Status ASN --</option>
                                    <option value="aktif" {{ old('status', $asn->status) == 'aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="nonaktif"
                                        {{ old('status', $asn->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="pensiun"
                                        {{ old('status', $asn->status) == 'pensiun' ? 'selected' : '' }}>Pensiun</option>
                                </select>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('asn.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <small>
                            Jika email diubah, password pegawai otomatis direset ke <b>password</b>
                        </small>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: `
                    <ul class="text-left">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `
            });
        @endif
    </script>
@endpush
