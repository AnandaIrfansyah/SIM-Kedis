@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary mb-0">
        <div class="card-header justify-content-center">
            <h4 class="">Login SIM Kedis</h4>
        </div>

        <div class="card-body py-0">

            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="email" placeholder="email"
                        value="{{ old('email') }}" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        Please fill in your email
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                        tabindex="2" required>
                    <div class="invalid-feedback">
                        Please fill in your password
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                    <div class="justify-content-center text-center">
                        <a href="{{ route('home') }}" class="btn btn-secondary my-3">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->has('login'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: '{{ $errors->first('login') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Coba Lagi'
                });
            });
        </script>
    @endif
@endpush
