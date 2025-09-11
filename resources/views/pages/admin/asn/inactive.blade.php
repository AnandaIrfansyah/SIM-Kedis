@extends('layouts.admin')

@section('title', 'Riwayat Pegawai Tidak Aktif')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Riwayat Pegawai Tidak Aktif</h1>
                <a href="{{ route('asn.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Data Aktif
                </a>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right mb-3">

                            <!-- Form pencarian -->
                            <form method="GET" action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari Nama" name="name"
                                        value="{{ request('name') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">
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
                                                <span
                                                    class="badge badge-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('asn.edit', $item->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('asn.destroy', $item->id) }}" method="POST"
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
