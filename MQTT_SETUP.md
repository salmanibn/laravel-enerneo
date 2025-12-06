# MQTT Integration - EnerNeo

## Setup Lengkap

### 1. Database
Tabel `mqtt_data` sudah dibuat dengan struktur:
- user_id (default: user_1)
- type (load, pv, batt)
- metric (voltage, current, power, energy, frequency, pf)
- value (desimal dengan 4 digit)
- timestamps

### 2. MQTT Subscriber Command
Command untuk subscribe ke MQTT HiveMQ Cloud dan simpan data ke database.

**Cara menjalankan:**
```bash
php artisan mqtt:subscribe
```

Command ini akan:
- Connect ke HiveMQ Cloud dengan TLS
- Subscribe ke topic `enerneo/user_1/#`
- Otomatis membagi voltage PV dan Battery dengan 4
- Menyimpan data ke database (update jika sudah ada)

### 3. Monitoring Page
Route `/monitoring` sudah diupdate untuk:
- Mengambil 10 data terakhir dari database
- Menampilkan grafik real-time
- Menampilkan gauge untuk nilai terbaru

**Akses:** http://127.0.0.1:8000/monitoring

### 4. MQTT Broker Config
- Server: 8288748b7bcb4d358e2ebbccd07b5cce.s1.eu.hivemq.cloud
- Port: 8883 (TLS)
- Username: EnerNeo
- Password: EnerNeo123

### 5. Topic Structure
```
enerneo/user_1/load/voltage
enerneo/user_1/load/current
enerneo/user_1/load/power
enerneo/user_1/load/energy
enerneo/user_1/load/frequency
enerneo/user_1/load/pf

enerneo/user_1/pv/voltage (dibagi 4)
enerneo/user_1/pv/current
enerneo/user_1/pv/power
enerneo/user_1/pv/energy

enerneo/user_1/batt/voltage (dibagi 4)
enerneo/user_1/batt/current
enerneo/user_1/batt/power
enerneo/user_1/batt/energy
```

## Cara Menjalankan

### Terminal 1: Laravel Server
```bash
php artisan serve
```

### Terminal 2: MQTT Subscriber
```bash
php artisan mqtt:subscribe
```

Setelah ESP32 publish data, data akan otomatis tersimpan di database dan tampil di halaman monitoring!

## Troubleshooting

### Jika koneksi MQTT gagal:
- Pastikan internet tersambung
- Cek credential HiveMQ Cloud
- Pastikan port 8883 tidak diblokir firewall

### Jika data tidak muncul di monitoring:
- Cek apakah mqtt:subscribe sudah running
- Cek database apakah ada data masuk: `SELECT * FROM mqtt_data;`
- Refresh halaman monitoring

## Auto-refresh (Optional)
Tambahkan JavaScript di `monitoring.blade.php` untuk auto-refresh setiap 5 detik:
```javascript
setTimeout(function(){
    location.reload();
}, 5000);
```
