@extends('layouts.admin')

@section('title', 'Tambah Kepemilikan Kendaraan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Kepemilikan Kendaraan</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Form Tambah Kepemilikan Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kepemilikan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Pilih ASN -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="asn_id">ASN</label>
                                        <select name="asn_id" id="asn_id" class="form-control selectric" required>
                                            <option value="">-- Pilih ASN --</option>
                                            @foreach ($asns as $asn)
                                                <option value="{{ $asn->id }}">{{ $asn->user->name }}
                                                    ({{ $asn->nip }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Pilih Kendaraan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kendaraan_id">Kendaraan</label>
                                        <select name="kendaraan_id" id="kendaraan_id" class="form-control selectric"
                                            required>
                                            <option value="">-- Pilih Kendaraan --</option>
                                            @foreach ($kendaraans as $kendaraan)
                                                <option value="{{ $kendaraan->id }}">
                                                    {{ $kendaraan->merk }} {{ $kendaraan->tipe }} -
                                                    {{ $kendaraan->no_polisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('kepemilikan.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
