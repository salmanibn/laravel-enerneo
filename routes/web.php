<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\MqttData;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/monitoring', function () {
    // Ambil data terbaru dari database (10 data terakhir untuk grafik)
    $recentData = MqttData::where('user_id', 'user_1')
        ->orderBy('updated_at', 'desc')
        ->limit(10)
        ->get()
        ->groupBy('metric');
    
    // Helper function untuk ambil data berdasarkan type dan metric
    $getData = function($type, $metric) use ($recentData) {
        $data = MqttData::where('user_id', 'user_1')
            ->where('type', $type)
            ->where('metric', $metric)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->reverse()
            ->pluck('value')
            ->toArray();
        
        // Jika data kosong, return array dengan 1 nilai 0
        return !empty($data) ? $data : [0];
    };
    
    // Generate labels (waktu)
    $timestamps = MqttData::where('user_id', 'user_1')
        ->orderBy('updated_at', 'desc')
        ->limit(10)
        ->get()
        ->reverse()
        ->pluck('updated_at')
        ->map(function($time) {
            return $time->format('H:i:s');
        })
        ->toArray();
    
    $labels = !empty($timestamps) ? $timestamps : ['N/A'];
    
    // Load data
    $loadData = [
        'voltage' => $getData('load', 'voltage'),
        'current' => $getData('load', 'current'),
        'power' => $getData('load', 'power'),
        'energy' => $getData('load', 'energy'),
        'frequency' => $getData('load', 'frequency'),
        'pf' => $getData('load', 'pf')
    ];
    
    // PV data (voltage sudah dibagi 4 di subscriber)
    $pvData = [
        'voltage' => $getData('pv', 'voltage'),
        'current' => $getData('pv', 'current'),
        'power' => $getData('pv', 'power'),
        'energy' => $getData('pv', 'energy')
    ];
    
    // Battery data (voltage sudah dibagi 4 di subscriber)
    $battData = [
        'voltage' => $getData('batt', 'voltage'),
        'current' => $getData('batt', 'current'),
        'power' => $getData('batt', 'power'),
        'energy' => $getData('batt', 'energy')
    ];
    
    return view('monitoring', compact('labels', 'loadData', 'pvData', 'battData'));
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/admin', function () {
    return view('admin');
});
