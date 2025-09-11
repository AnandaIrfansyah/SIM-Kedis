@extends('layouts.auth')

@section('title', 'Update Password')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('main')
    <div class="card card-primary mb-0">
        <div class="card-header justify-content-center">
            <h4>Update Password</h4>
        </div>

        <div class="card-body py-0">
            <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', auth()->user()->email) }}" required autofocus>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password Lama --}}
                <div class="form-group">
                    <label for="current_password">Password Lama</label>
                    <input id="current_password" type="password"
                        class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                        required>
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input id="new_password" type="password"
                        class="form-control pwstrength @error('new_password') is-invalid @enderror" name="new_password"
                        data-indicator="pwindicator" required>
                    <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Konfirmasi Password Baru --}}
                <div class="form-group">
                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input id="new_password_confirmation" type="password" class="form-control"
                        name="new_password_confirmation" required>
                </div>

                {{-- Tombol --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Update Password
                    </button>
                    <div class="justify-content-center text-center">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('js/page/auth-register.js') }}"></script>

    {{-- Success Alert --}}
    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('status') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    {{-- Error Alert --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ $errors->first() }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Coba Lagi'
                });
            });
        </script>
    @endif
@endpush
