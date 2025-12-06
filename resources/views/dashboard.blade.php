@extends('layouts.app')

@section('title', 'Dashboard - Realtime Monitoring')

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #0A0F18 0%, #1a1f2e 100%);
    color: white;
    min-height: 100vh;
}

.monitoring-header {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    animation: fadeIn 0.5s ease-in;
}

.monitoring-header h1 {
    color: #4CC9FF;
    font-weight: bold;
    margin: 0;
    text-shadow: 0 0 20px rgba(76, 201, 255, 0.5);
}

.mode-toggle {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-bottom: 30px;
}

.mode-btn {
    padding: 12px 30px;
    border: 2px solid #4CC9FF;
    background: rgba(76, 201, 255, 0.1);
    color: #4CC9FF;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.mode-btn:hover {
    background: rgba(76, 201, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(76, 201, 255, 0.3);
}

.mode-btn.active {
    background: #4CC9FF;
    color: #0A0F18;
    box-shadow: 0 0 20px rgba(76, 201, 255, 0.6);
}

.mode-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.mode-btn:active::before {
    width: 300px;
    height: 300px;
}

.chart-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    animation: fadeIn 0.6s ease-out;
}

@media (min-width: 768px) {
    .chart-container {
        grid-template-columns: repeat(3, 1fr);
    }
}

.chart-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    animation: slideUp 0.6s ease-out;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    max-width: 500px;
    margin: 0 auto;
}

.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(76, 201, 255, 0.3);
    border-color: rgba(76, 201, 255, 0.5);
}

.chart-card h3 {
    color: #4CC9FF;
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: 600;
    text-align: center;
}

.gauge-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    animation: fadeIn 0.6s ease-out;
}

@media (min-width: 768px) {
    .gauge-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.gauge-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 25px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
    transition: all 0.3s ease;
    animation: scaleIn 0.5s ease-out;
    max-width: 500px;
    margin: 0 auto;
}

.gauge-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 30px rgba(76, 201, 255, 0.3);
    border-color: rgba(76, 201, 255, 0.5);
}

.gauge-card h3 {
    color: #4CC9FF;
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: 600;
}

.gauge-canvas-container {
    width: 100%;
    height: 200px;
    position: relative;
    margin-bottom: 10px;
}

.gauge-canvas {
    max-width: 100%;
    max-height: 100%;
}

.gauge-value {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    margin: 10px 0;
    text-shadow: 0 0 10px rgba(76, 201, 255, 0.5);
}

.gauge-unit {
    color: #4CC9FF;
    font-size: 14px;
}

.status-indicator {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 8px;
    animation: pulse 2s infinite;
}

.status-connected {
    background: #00ff00;
    box-shadow: 0 0 10px #00ff00;
}

.status-disconnected {
    background: #ff0000;
    box-shadow: 0 0 10px #ff0000;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #0A0F18;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    width: 60px;
    height: 60px;
    border: 5px solid rgba(76, 201, 255, 0.3);
    border-top-color: #4CC9FF;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.loading-text {
    margin-top: 20px;
    color: #4CC9FF;
    font-size: 18px;
}
</style>
@endpush

@section('header')
<header style="position:fixed;top:0;left:0;width:100%;height:70px;background:#181818;color:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 2.5rem;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
    <div style="display:flex;align-items:center;gap:1rem;">
           <a href="/">
               <img src="/icon/ENERNEO-H.png" alt="EnerNeo Logo" style="width:160px;height:120px;object-fit:cover;">
           </a>
    </div>
</header>
@endsection

@section('content')
<!-- Loading Screen -->
<div id="loadingScreen" class="loading-screen" style="display: none;">
    <div class="spinner"></div>
    <div class="loading-text">Connecting to MQTT...</div>
</div>

<div class="container py-5">
    <!-- Header -->
    <div class="monitoring-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>
                <span id="statusIndicator" class="status-indicator status-disconnected"></span>
                EnerNeo Realtime Monitoring
            </h1>
            <div>
                <small id="connectionStatus" style="color: #ff0000;">Disconnected</small>
            </div>
        </div>
    </div>

    <!-- Mode Toggle -->
    <div class="mode-toggle">
        <button id="chartModeBtn" class="mode-btn active">Chart Mode</button>
        <button id="gaugeModeBtn" class="mode-btn">Gauge Mode</button>
    </div>

    <!-- Chart Mode -->
    <div id="chartMode" class="chart-container">
        <div class="chart-card">
            <h3>Voltage</h3>
            <canvas id="chartVoltage" height="150"></canvas>
        </div>
        <div class="chart-card">
            <h3>Current</h3>
            <canvas id="chartCurrent" height="150"></canvas>
        </div>
        <div class="chart-card">
            <h3>Power</h3>
            <canvas id="chartPower" height="150"></canvas>
        </div>
        <div class="chart-card">
            <h3>Frequency</h3>
            <canvas id="chartFrequency" height="150"></canvas>
        </div>
        <div class="chart-card">
            <h3>Power Factor</h3>
            <canvas id="chartPF" height="150"></canvas>
        </div>
    </div>

    <!-- Gauge Mode -->
    <div id="gaugeMode" class="gauge-grid" style="display: none;">
        <div class="gauge-card">
            <h3>Voltage</h3>
            <div class="gauge-canvas-container">
                <canvas id="gaugeVoltage" class="gauge-canvas"></canvas>
            </div>
            <div class="gauge-value" id="voltageValue">0 V</div>
        </div>
        <div class="gauge-card">
            <h3>Current</h3>
            <div class="gauge-canvas-container">
                <canvas id="gaugeCurrent" class="gauge-canvas"></canvas>
            </div>
            <div class="gauge-value" id="currentValue">0 A</div>
        </div>
        <div class="gauge-card">
            <h3>Power</h3>
            <div class="gauge-canvas-container">
                <canvas id="gaugePower" class="gauge-canvas"></canvas>
            </div>
            <div class="gauge-value" id="powerValue">0 W</div>
        </div>
        <div class="gauge-card">
            <h3>Frequency</h3>
            <div class="gauge-canvas-container">
                <canvas id="gaugeFrequency" class="gauge-canvas"></canvas>
            </div>
            <div class="gauge-value" id="frequencyValue">0 Hz</div>
        </div>
        <div class="gauge-card">
            <h3>Power Factor</h3>
            <div class="gauge-canvas-container">
                <canvas id="gaugePF" class="gauge-canvas"></canvas>
            </div>
            <div class="gauge-value" id="pfValue">0 PF</div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer style="width:100vw;background:#181818;color:#fff;text-align:center;padding:1rem 0;position:fixed;bottom:0;left:0;z-index:99;box-shadow:0 -2px 8px rgba(0,0,0,0.08);">
    &copy; {{ date('Y') }} EnerNeo. All rights reserved.
</footer>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>
// Monitoring Data
let monitoringData = {
    voltage: 0,
    current: 0,
    power: 0,
    frequency: 0,
    pf: 0
};

// Chart Configuration
let charts = {};
let chartHistory = {
    voltage: [],
    current: [],
    power: [],
    frequency: [],
    pf: []
};
const maxDataPoints = 20;

function createLineChart(canvasId, label, color) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: label,
                data: [],
                borderColor: color,
                backgroundColor: color.replace('1)', '0.2)'),
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 3,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: {
                duration: 300
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#4CC9FF'
                    }
                },
                x: {
                    display: false,
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

function initChart() {
    charts.voltage = createLineChart('chartVoltage', 'Voltage (V)', 'rgba(76, 201, 255, 1)');
    charts.current = createLineChart('chartCurrent', 'Current (A)', 'rgba(255, 99, 132, 1)');
    charts.power = createLineChart('chartPower', 'Power (W)', 'rgba(255, 206, 86, 1)');
    charts.frequency = createLineChart('chartFrequency', 'Frequency (Hz)', 'rgba(75, 192, 192, 1)');
    charts.pf = createLineChart('chartPF', 'Power Factor', 'rgba(153, 102, 255, 1)');
}

// Needle Gauge Drawing Function
let gauges = {};

function drawNeedleGauge(canvasId, value, min, max, label, color) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const width = canvas.width = canvas.offsetWidth;
    const height = canvas.height = canvas.offsetHeight;
    const centerX = width / 2;
    const centerY = height * 0.75;
    const radius = Math.min(width, height) * 0.35;
    
    // Clear canvas
    ctx.clearRect(0, 0, width, height);
    
    // Draw arc background
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, Math.PI, 2 * Math.PI, false);
    ctx.lineWidth = 15;
    ctx.strokeStyle = 'rgba(255, 255, 255, 0.1)';
    ctx.stroke();
    
    // Calculate value angle
    const percentage = (value - min) / (max - min);
    const angle = Math.PI + (percentage * Math.PI);
    
    // Draw value arc
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, Math.PI, angle, false);
    ctx.lineWidth = 15;
    ctx.strokeStyle = color;
    ctx.stroke();
    
    // Draw tick marks
    for (let i = 0; i <= 10; i++) {
        const tickAngle = Math.PI + (i / 10) * Math.PI;
        const tickLength = i % 2 === 0 ? 15 : 10;
        const startX = centerX + (radius - 5) * Math.cos(tickAngle);
        const startY = centerY + (radius - 5) * Math.sin(tickAngle);
        const endX = centerX + (radius - tickLength - 5) * Math.cos(tickAngle);
        const endY = centerY + (radius - tickLength - 5) * Math.sin(tickAngle);
        
        ctx.beginPath();
        ctx.moveTo(startX, startY);
        ctx.lineTo(endX, endY);
        ctx.strokeStyle = 'rgba(255, 255, 255, 0.5)';
        ctx.lineWidth = 2;
        ctx.stroke();
    }
    
    // Draw needle
    const needleLength = radius - 20;
    const needleX = centerX + needleLength * Math.cos(angle);
    const needleY = centerY + needleLength * Math.sin(angle);
    
    // Needle shadow
    ctx.beginPath();
    ctx.moveTo(centerX, centerY);
    ctx.lineTo(needleX + 2, needleY + 2);
    ctx.lineWidth = 4;
    ctx.strokeStyle = 'rgba(0, 0, 0, 0.3)';
    ctx.stroke();
    
    // Needle
    ctx.beginPath();
    ctx.moveTo(centerX, centerY);
    ctx.lineTo(needleX, needleY);
    ctx.lineWidth = 4;
    ctx.strokeStyle = color;
    ctx.stroke();
    
    // Draw center circle
    ctx.beginPath();
    ctx.arc(centerX, centerY, 8, 0, 2 * Math.PI);
    ctx.fillStyle = color;
    ctx.fill();
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.stroke();
    
    // Draw min and max labels
    ctx.font = '12px Arial';
    ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
    ctx.textAlign = 'left';
    ctx.fillText(min.toString(), centerX - radius + 10, centerY + 5);
    ctx.textAlign = 'right';
    ctx.fillText(max.toString(), centerX + radius - 10, centerY + 5);
}

function initGauges() {
    gauges = {
        voltage: { canvas: 'gaugeVoltage', min: 0, max: 250, color: 'rgba(76, 201, 255, 1)' },
        current: { canvas: 'gaugeCurrent', min: 0, max: 20, color: 'rgba(255, 99, 132, 1)' },
        power: { canvas: 'gaugePower', min: 0, max: 5000, color: 'rgba(255, 206, 86, 1)' },
        frequency: { canvas: 'gaugeFrequency', min: 0, max: 70, color: 'rgba(75, 192, 192, 1)' },
        pf: { canvas: 'gaugePF', min: 0, max: 1, color: 'rgba(153, 102, 255, 1)' }
    };
}

// Update Chart
function updateChart() {
    const timestamp = new Date().toLocaleTimeString();
    
    // Update voltage
    chartHistory.voltage.push(monitoringData.voltage);
    if (chartHistory.voltage.length > maxDataPoints) chartHistory.voltage.shift();
    charts.voltage.data.labels.push(timestamp);
    if (charts.voltage.data.labels.length > maxDataPoints) charts.voltage.data.labels.shift();
    charts.voltage.data.datasets[0].data = chartHistory.voltage;
    charts.voltage.update('none');
    
    // Update current
    chartHistory.current.push(monitoringData.current);
    if (chartHistory.current.length > maxDataPoints) chartHistory.current.shift();
    charts.current.data.labels.push(timestamp);
    if (charts.current.data.labels.length > maxDataPoints) charts.current.data.labels.shift();
    charts.current.data.datasets[0].data = chartHistory.current;
    charts.current.update('none');
    
    // Update power
    chartHistory.power.push(monitoringData.power);
    if (chartHistory.power.length > maxDataPoints) chartHistory.power.shift();
    charts.power.data.labels.push(timestamp);
    if (charts.power.data.labels.length > maxDataPoints) charts.power.data.labels.shift();
    charts.power.data.datasets[0].data = chartHistory.power;
    charts.power.update('none');
    
    // Update frequency
    chartHistory.frequency.push(monitoringData.frequency);
    if (chartHistory.frequency.length > maxDataPoints) chartHistory.frequency.shift();
    charts.frequency.data.labels.push(timestamp);
    if (charts.frequency.data.labels.length > maxDataPoints) charts.frequency.data.labels.shift();
    charts.frequency.data.datasets[0].data = chartHistory.frequency;
    charts.frequency.update('none');
    
    // Update PF
    chartHistory.pf.push(monitoringData.pf);
    if (chartHistory.pf.length > maxDataPoints) chartHistory.pf.shift();
    charts.pf.data.labels.push(timestamp);
    if (charts.pf.data.labels.length > maxDataPoints) charts.pf.data.labels.shift();
    charts.pf.data.datasets[0].data = chartHistory.pf;
    charts.pf.update('none');
}

// Update Gauge
function updateGauge() {
    drawNeedleGauge('gaugeVoltage', monitoringData.voltage, 0, 250, 'Voltage', 'rgba(76, 201, 255, 1)');
    drawNeedleGauge('gaugeCurrent', monitoringData.current, 0, 20, 'Current', 'rgba(255, 99, 132, 1)');
    drawNeedleGauge('gaugePower', monitoringData.power, 0, 5000, 'Power', 'rgba(255, 206, 86, 1)');
    drawNeedleGauge('gaugeFrequency', monitoringData.frequency, 0, 70, 'Frequency', 'rgba(75, 192, 192, 1)');
    drawNeedleGauge('gaugePF', monitoringData.pf, 0, 1, 'PF', 'rgba(153, 102, 255, 1)');
    
    document.getElementById('voltageValue').textContent = monitoringData.voltage.toFixed(2) + ' V';
    document.getElementById('currentValue').textContent = monitoringData.current.toFixed(2) + ' A';
    document.getElementById('powerValue').textContent = monitoringData.power.toFixed(1) + ' W';
    document.getElementById('frequencyValue').textContent = monitoringData.frequency.toFixed(1) + ' Hz';
    document.getElementById('pfValue').textContent = monitoringData.pf.toFixed(2) + ' PF';
    
    // Add animation effect
    animateValue('voltageValue');
    animateValue('currentValue');
    animateValue('powerValue');
    animateValue('frequencyValue');
    animateValue('pfValue');
}

function animateValue(elementId) {
    const element = document.getElementById(elementId);
    element.style.transform = 'scale(1.1)';
    element.style.color = '#4CC9FF';
    setTimeout(() => {
        element.style.transform = 'scale(1)';
        element.style.color = '#fff';
    }, 200);
}

// Mode Toggle
let currentMode = 'chart';

document.getElementById('chartModeBtn').addEventListener('click', function() {
    currentMode = 'chart';
    document.getElementById('chartMode').style.display = 'block';
    document.getElementById('gaugeMode').style.display = 'none';
    this.classList.add('active');
    document.getElementById('gaugeModeBtn').classList.remove('active');
});

document.getElementById('gaugeModeBtn').addEventListener('click', function() {
    currentMode = 'gauge';
    document.getElementById('chartMode').style.display = 'none';
    document.getElementById('gaugeMode').style.display = 'grid';
    this.classList.add('active');
    document.getElementById('chartModeBtn').classList.remove('active');
    initGauges();
    updateGauge();
});

// MQTT Configuration
const loadingScreen = document.getElementById('loadingScreen');
const statusIndicator = document.getElementById('statusIndicator');
const connectionStatus = document.getElementById('connectionStatus');

loadingScreen.style.display = 'flex';

const client = mqtt.connect("wss://8288748b7bcb4d358e2ebbccd07b5cce.s1.eu.hivemq.cloud:8884/mqtt", {
    username: "EnerNeo",
    password: "EnerNeo123"
});

client.on("connect", () => {
    console.log("Connected to MQTT");
    loadingScreen.style.display = 'none';
    statusIndicator.className = 'status-indicator status-connected';
    connectionStatus.textContent = 'Connected';
    connectionStatus.style.color = '#00ff00';
    
    client.subscribe("enerneo/esp32_1/load/#", (err) => {
        if (err) {
            console.error("Subscription error:", err);
        } else {
            console.log("Subscribed to topics");
        }
    });
});

client.on("message", (topic, payload) => {
    const value = parseFloat(payload.toString());
    
    if (topic.endsWith("voltage")) {
        monitoringData.voltage = value;
    } else if (topic.endsWith("current")) {
        monitoringData.current = value;
    } else if (topic.endsWith("power")) {
        monitoringData.power = value;
    } else if (topic.endsWith("frequency")) {
        monitoringData.frequency = value;
    } else if (topic.endsWith("pf")) {
        monitoringData.pf = value;
    }
    
    // Update UI based on current mode
    if (currentMode === 'chart') {
        updateChart();
    } else {
        updateGauge();
    }
});

client.on("error", (err) => {
    console.error("MQTT Error:", err);
    statusIndicator.className = 'status-indicator status-disconnected';
    connectionStatus.textContent = 'Error';
    connectionStatus.style.color = '#ff0000';
});

client.on("close", () => {
    console.log("MQTT Connection Closed");
    statusIndicator.className = 'status-indicator status-disconnected';
    connectionStatus.textContent = 'Disconnected';
    connectionStatus.style.color = '#ff0000';
});

// Initialize Chart on Load
initChart();
initGauges();
</script>
@endpush
