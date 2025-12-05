@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Dashboard Monitoring Energi</h2>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Tegangan</h5>
                    <div class="display-4 text-primary">220 V</div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Arus</h5>
                    <div class="display-4 text-success">5.2 A</div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Daya</h5>
                    <div class="display-4 text-warning">1144 W</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
