@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100" style="background:#f8f9fa;">
    <div class="container p-4 shadow rounded-4 bg-white" style="max-width:400px;">
        <h2 class="text-center mb-4">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <span>Belum memiliki akun? <a href="{{ route('register') }}">Register</a></span>
        </div>
    </div>
</div>
@endsection
