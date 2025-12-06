@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100" style="background:#f8f9fa;">
    <div class="container p-4 shadow rounded-4 bg-white" style="max-width:400px;">
        <h2 class="text-center mb-4">Register Monitoring Enerneo</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required autofocus>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        <div class="text-center mt-3">
            <span>Sudah memiliki akun? <a href="{{ route('login') }}">Login</a></span>
        </div>
    </div>
</div>

<footer style="width:100vw;background:#181818;color:#fff;text-align:center;padding:1rem 0;position:fixed;bottom:0;left:0;z-index:99;box-shadow:0 -2px 8px rgba(0,0,0,0.08);">
    &copy; {{ date('Y') }} EnerNeo. All rights reserved.
</footer>

@section('footer')
<footer style="width:100%;background:#181818;color:#fff;text-align:center;padding:1rem 0;position:fixed;bottom:0;left:0;z-index:99;">
    &copy; {{ date('Y') }} EnerNeo Monitoring. All rights reserved.
</footer>
@endsection
