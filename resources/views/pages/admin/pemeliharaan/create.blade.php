@extends('layouts.admin')

@section('title', 'Tambah Pemeliharaan')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Pemeliharaan</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('pemeliharaanKendaraan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kendaraan</label>
                                        <input type="text" class="form-control"
                                            value="{{ $kendaraan->merk }} {{ $kendaraan->tipe }} - {{ $kendaraan->no_polisi }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal Pemeliharaan <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_pemeliharaan" class="form-control datepicker"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Nota</label>
                                        <input type="text" name="nomor_nota" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bengkel</label>
                                        <select name="bengkel_id" id="bengkelSelect" class="form-control select2">
                                            <option value="">-- Pilih Bengkel --</option>
                                            @foreach ($bengkels as $bengkel)
                                                <option value="{{ $bengkel->id }}">{{ $bengkel->nama }} -
                                                    {{ $bengkel->alamat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kilometer</label>
                                        <input type="number" name="kilometer" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div id="manualBengkelFields" class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Bengkel Manual</label>
                                        <input type="text" name="nama_bengkel_manual" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Bengkel Manual</label>
                                        <input type="text" name="alamat_bengkel_manual" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Uraian</label>
                                        <input type="text" name="uraian" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Biaya</label>
                                        <input type="number" step="0.01" name="biaya" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Pemeliharaan</label>
                                        <select name="jenis_pemeliharaan" class="form-control selectric">
                                            <option value="">-- Pilih --</option>
                                            <option value="suku cadang">Suku Cadang</option>
                                            <option value="pelumas">Pelumas</option>
                                            <option value="servis">Servis</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control summernote-simple" rows="3"></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            function toggleManualBengkel() {
                if ($('#bengkelSelect').val()) {
                    $('#manualBengkelFields').hide();
                } else {
                    $('#manualBengkelFields').show();
                }
            }

            toggleManualBengkel();

            $('#bengkelSelect').on('change', function() {
                toggleManualBengkel();
            });
        });
    </script>
@endpush
