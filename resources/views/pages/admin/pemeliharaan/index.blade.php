@extends('layouts.admin')

@section('title', 'Pemeliharaan Kendaraan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Pemeliharaan Kendaraan</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-white">No</th>
                                        <th class="text-center text-white">Kendaraan</th>
                                        <th class="text-center text-white">Warna</th>
                                        <th class="text-center text-white">No Polisi</th>
                                        <th class="text-center text-white">Tahun</th>
                                        <th class="text-center text-white">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kendaraans as $index => $kendaraan)
                                        <tr>
                                            <td class="text-center">{{ $index + $kendaraans->firstItem() }}</td>
                                            <td class="text-center">{{ $kendaraan->merk }} {{ $kendaraan->tipe }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ $kendaraan->no_polisi }}</td>
                                            <td class="text-center">{{ $kendaraan->tahun }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('pemeliharaanKendaraan.show', $kendaraan->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-tools"></i> Detail Pemeliharaan
                                                </a>
                                                <a href="{{ route('pemeliharaanKendaraan.create', $kendaraan->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-wrench"></i> Tambah Pemeliharaan
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $kendaraans->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
