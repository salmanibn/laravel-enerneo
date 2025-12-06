@extends('layouts.app')

<header style="position:fixed;top:0;left:0;width:100%;height:70px;background:#181818;color:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 2.5rem;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
    <div style="display:flex;align-items:center;gap:1rem;">
           <a href="/">
               <img src="/icon/ENERNEO-H.png" alt="EnerNeo Logo" style="width:160px;height:120px;object-fit:cover;">
           </a>
    </div>

</header>

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100" style="background:#f8f9fa;">
    <div class="container p-4 shadow rounded-4 bg-white" style="max-width:400px;">
        <h2 class="text-center mb-4">LOGIN</h2>
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
    </div>
</div>
@endsection


<footer style="width:100vw;background:#181818;color:#fff;text-align:center;padding:1rem 0;position:fixed;bottom:0;left:0;z-index:99;box-shadow:0 -2px 8px rgba(0,0,0,0.08);">
    &copy; {{ date('Y') }} EnerNeo. All rights reserved.
</footer>
