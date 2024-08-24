@extends('layouts.auth', ['title' => 'Register'])

@section('content')
    <div class="card border-0">
        <div class="card-body p-4 p-lg-5">
            <a href="." class="logo justify-content-center mb-5">
                <img src="{{ url('assets/images/logo.png') }}" alt="Logo">
                <span>Car Rental</span>
            </a>
            <h4 class="text-dark fw-bold mb-4">Daftar</h4>

            <a href="{{ route('google.redirect') }}" class="btn btn-light border-dark color-dark rounded-3 w-100 mt-2 mb-4">
                <img src="{{ url('assets/images/google-icon.png') }}" style="width: 20px;" alt="Google Icon">
                Daftar dengan Google
            </a>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="mb-1">Nama Lengkap</label>
                    <input type="text"  id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" autocomplete="name" required autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="mb-1">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan email" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="mb-1">Password</label>
                    <div class="d-flex align-items-center position-relative">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" style="padding-right: 45px;" placeholder="Masukkan password" required>
                        <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100" id="showPass" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;" onclick="showPass()">
                            <i class="fa-regular fa-eye-slash"></i>
                        </div> 
                    </div>
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="mb-1">Konfirmasi Password</label>
                    <div class="d-flex align-items-center position-relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" style="padding-right: 45px;" placeholder="Masukkan ulang password" required>
                        <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100" id="showPass2" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;" onclick="showPass2()">
                            <i class="fa-regular fa-eye-slash"></i>
                        </div> 
                    </div>
                </div>

                <button class="btn btn-primary d-block w-100" type="submit">Daftar</button>
                <p class="mb-0 mt-2 text-secondary text-center">
                    Sudah Memiliki Akun?
                    <a href="{{ route('login') }}" class="text-decoration-underline text-primary">Masuk</a>
                </p>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ url('assets/js/auth.js') }}"></script>
@endpush
