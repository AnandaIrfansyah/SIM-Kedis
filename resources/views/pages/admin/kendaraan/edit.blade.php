@extends('layouts.admin')

@section('title', 'Edit Kendaraan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Kendaraan</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Form Edit Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Kolom kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="merk">Merk</label>
                                        <input type="text" id="merk" name="merk" class="form-control"
                                            value="{{ old('merk', $kendaraan->merk) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipe">Tipe</label>
                                        <input type="text" id="tipe" name="tipe" class="form-control"
                                            value="{{ old('tipe', $kendaraan->tipe) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_polisi">No Polisi</label>
                                        <input type="text" id="no_polisi" name="no_polisi" class="form-control"
                                            value="{{ old('no_polisi', $kendaraan->no_polisi) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_rangka">No Rangka</label>
                                        <input type="text" id="no_rangka" name="no_rangka" class="form-control"
                                            value="{{ old('no_rangka', $kendaraan->no_rangka) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_mesin">No Mesin</label>
                                        <input type="text" id="no_mesin" name="no_mesin" class="form-control"
                                            value="{{ old('no_mesin', $kendaraan->no_mesin) }}">
                                    </div>
                                </div>

                                <!-- Kolom kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" id="tahun" name="tahun" class="form-control" 
                                            value="{{ old('tahun', $kendaraan->tahun) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis">Jenis</label>
                                        <input type="text" id="jenis" name="jenis" class="form-control"
                                            value="{{ old('jenis', $kendaraan->jenis) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jatuh_tempo_pajak">Jatuh Tempo Pajak</label>
                                        <input type="date" id="jatuh_tempo_pajak" name="jatuh_tempo_pajak"
                                            class="form-control"
                                            value="{{ old('jatuh_tempo_pajak', $kendaraan->jatuh_tempo_pajak) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jatuh_tempo_stnk">Jatuh Tempo STNK</label>
                                        <input type="date" id="jatuh_tempo_stnk" name="jatuh_tempo_stnk"
                                            class="form-control"
                                            value="{{ old('jatuh_tempo_stnk', $kendaraan->jatuh_tempo_stnk) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto Kendaraan</label>
                                        @if ($kendaraan->foto)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $kendaraan->foto) }}" alt="Foto Kendaraan"
                                                    width="150">
                                            </div>
                                        @endif
                                        <input type="file" id="foto" name="foto" class="form-control">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                    </div>
                                    <div class="form-group">
                                        <label>QR Code</label>
                                        @if ($kendaraan->qr_code)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/qr_code/' . $kendaraan->id . '.png') }}"
                                                    alt="QR Code" width="150">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control selectric">
                                            <option value="aktif" {{ $kendaraan->status == 'aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="nonaktif"
                                                {{ $kendaraan->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
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
