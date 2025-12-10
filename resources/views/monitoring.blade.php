

@extends('layouts.app')

@push('styles')
<style>
body {
	background: linear-gradient(135deg, #0A0F18 0%, #1a1f2e 100%);
	color: white;
	min-height: 100vh;
}
.monitoring-header {
	background: rgba(255,255,255,0.05);
	backdrop-filter: blur(10px);
	border-radius: 15px;
	padding: 20px;
	margin-bottom: 30px;
	border: 1px solid rgba(255,255,255,0.1);
	animation: fadeIn 0.5s ease-in;
}
.monitoring-header h1 {
	color: #4CC9FF;
	font-weight: bold;
	margin: 0;
	text-shadow: 0 0 20px rgba(76,201,255,0.5);
}
.gauge-grid {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 25px;
	animation: fadeIn 0.6s ease-out;
}
.gauge-card {
	background: rgba(255,255,255,0.05);
	backdrop-filter: blur(10px);
	border-radius: 15px;
	padding: 25px;
	border: 1px solid rgba(255,255,255,0.1);
	text-align: center;
	transition: all 0.3s ease;
	animation: scaleIn 0.5s ease-out;
	max-width: 350px;
	margin: 0 auto;
	height: 200px;
}
.gauge-card h3 {
	color: #4CC9FF;
	font-size: 30px;
	margin-bottom: 15px;
	font-weight: 600;
}
.gauge-canvas-container {
	width: 400px;
	max-width: 100%;
	height: 180px;
	position: relative;
	margin: 0 auto 10px auto;
}
.gauge-value {
	font-size: 40px;
	font-weight: bold;
	color: #ffffff;
	margin: 10px 0;
	text-shadow: 0 0 10px rgba(76,201,255,0.5);
}
.chart-container {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 25px;
	animation: fadeIn 0.6s ease-out;
}
.chart-card {
	background: rgba(255,255,255,0.05);
	backdrop-filter: blur(10px);
	border-radius: 15px;
	padding: 20px;
	border: 1px solid rgba(255,255,255,0.1);
	animation: slideUp 0.6s ease-out;
	box-shadow: 0 8px 32px rgba(0,0,0,0.3);
	transition: all 0.3s ease;
	max-width: 600px;
	margin: 0 auto;
}
.chart-card h3 {
	color: #4CC9FF;
	font-size: 18px;
	margin-bottom: 15px;
	font-weight: 600;
	text-align: center;
}
@keyframes fadeIn {
	from { opacity: 0; }
	to { opacity: 1; }
}
@keyframes slideUp {
	from { opacity: 0; transform: translateY(30px); }
	to { opacity: 1; transform: translateY(0); }
}
@keyframes scaleIn {
	from { opacity: 0; transform: scale(0.9); }
	to { opacity: 1; transform: scale(1); }
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
<div class="container py-5">
	<div class="monitoring-header">
		<h1>EnerNeo Monitoring</h1>
	</div>
	<div class="chart-gauge-block" style="margin-bottom: 40px; border: 2px solid #4CC9FF; border-radius: 15px; padding: 18px; background: rgba(255,255,255,0.03);">
	<h2 style="color:#4CC9FF; margin-bottom:18px;">LOAD</h2>
	<div class="chart-card" style="max-width:1200px; margin:0 auto;">
			<h3>Load</h3>
			<canvas id="chartLoad" style="width:100%;height:350px;min-height:300px;"></canvas>
		</div>
		<div class="gauge-group" style="margin-top: 18px; border-radius: 15px; padding: 16px;">
			<div class="gauge-grid">
				<div class="gauge-card">
					<h3>Load Voltage</h3>
					<div class="gauge-canvas-container"><div id="gaugeLoadVoltage"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Load Current</h3>
					<div class="gauge-canvas-container"><div id="gaugeLoadCurrent"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Load Power</h3>
					<div class="gauge-canvas-container"><div id="gaugeLoadPower"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Load Energy</h3>
					<div class="gauge-canvas-container"><div id="gaugeLoadEnergy"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Load Frequency</h3>
					<div class="gauge-canvas-container"><div id="gaugeLoadFrequency"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Load Power Factor</h3>
					<div class="gauge-canvas-container"><div id="gaugeLoadPF"></div></div>
				</div>
			</div>
		</div>
	</div>
	<div class="chart-gauge-block" style="margin-bottom: 40px; border: 2px solid #4CC9FF; border-radius: 15px; padding: 18px; background: rgba(255,255,255,0.03);">
	<h2 style="color:#43e97b; margin-bottom:18px;">PV</h2>
	<div class="chart-card" style="max-width:1200px; margin:0 auto;">
			<canvas id="chartPV" style="width:100%;height:350px;min-height:300px;"></canvas>
		</div>
		<div class="gauge-group" style="margin-top: 18px; padding: 16px;">

			<div class="gauge-grid">
				<div class="gauge-card">
					<h3>PV Voltage</h3>
					<div class="gauge-canvas-container"><div id="gaugePVVoltage"></div></div>
				</div>
				<div class="gauge-card">
					<h3>PV Current</h3>
					<div class="gauge-canvas-container"><div id="gaugePVCurrent"></div></div>
				</div>
				<div class="gauge-card">
					<h3>PV Power</h3>
					<div class="gauge-canvas-container"><div id="gaugePVPower"></div></div>
				</div>
				<div class="gauge-card">
					<h3>PV Energy</h3>
					<div class="gauge-canvas-container"><div id="gaugePVEnergy"></div></div>
				</div>
			</div>
		</div>
	</div>
	<div class="chart-gauge-block" style="margin-bottom: 40px; border: 2px solid #4CC9FF; border-radius: 15px; padding: 18px; background: rgba(255,255,255,0.03);">
			<h2 style="color:#ffb347; margin-bottom:18px;">BATTERY</h2>
	<div class="chart-card" style="max-width:1200px; margin:0 auto;">
			<canvas id="chartBatt" style="width:100%;height:350px;min-height:300px;"></canvas>
		</div>
		<div class="gauge-group" style="margin-top: 18px; padding: 16px;">

			<div class="gauge-grid">
				<div class="gauge-card">
					<h3>Batt Voltage</h3>
					<div class="gauge-canvas-container"><div id="gaugeBattVoltage"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Batt Current</h3>
					<div class="gauge-canvas-container"><div id="gaugeBattCurrent"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Batt Power</h3>
					<div class="gauge-canvas-container"><div id="gaugeBattPower"></div></div>
				</div>
				<div class="gauge-card">
					<h3>Batt Energy</h3>
					<div class="gauge-canvas-container"><div id="gaugeBattEnergy"></div></div>
				</div>
			</div>
		</div>
	</div>

	</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/justgage"></script>
<script src="https://cdn.jsdelivr.net/npm/raphael"></script>
<script>
	// Data dari controller
	var loadData = {!! json_encode($loadData) !!};
	var pvData = {!! json_encode($pvData) !!};
	var battData = {!! json_encode($battData) !!};
	var labels = {!! json_encode($labels) !!};

	// Gauges Load
	new JustGage({ id: "gaugeLoadVoltage", value: loadData.voltage.slice(-1)[0] || 0, min: 0, max: 300, title: "Load Voltage (V)" });
	new JustGage({ id: "gaugeLoadCurrent", value: loadData.current.slice(-1)[0] || 0, min: 0, max: 100, title: "Load Current (A)" });
	new JustGage({ id: "gaugeLoadPower", value: loadData.power.slice(-1)[0] || 0, min: 0, max: 5000, title: "Load Power (W)" });
	new JustGage({ id: "gaugeLoadEnergy", value: loadData.energy.slice(-1)[0] || 0, min: 0, max: 10000, title: "Load Energy (kWh)" });
	new JustGage({ id: "gaugeLoadFrequency", value: loadData.frequency.slice(-1)[0] || 0, min: 0, max: 100, title: "Load Frequency (Hz)" });
	new JustGage({ id: "gaugeLoadPF", value: loadData.pf.slice(-1)[0] || 0, min: 0, max: 1, title: "Load Power Factor" });

	// Gauges PV
	new JustGage({ id: "gaugePVVoltage", value: pvData.voltage.slice(-1)[0] || 0, min: 0, max: 100, title: "PV Voltage (V)" });
	new JustGage({ id: "gaugePVCurrent", value: pvData.current.slice(-1)[0] || 0, min: 0, max: 100, title: "PV Current (A)" });
	new JustGage({ id: "gaugePVPower", value: pvData.power.slice(-1)[0] || 0, min: 0, max: 5000, title: "PV Power (W)" });
	new JustGage({ id: "gaugePVEnergy", value: pvData.energy.slice(-1)[0] || 0, min: 0, max: 10000, title: "PV Energy (kWh)" });

	// Gauges Battery
	new JustGage({ id: "gaugeBattVoltage", value: battData.voltage.slice(-1)[0] || 0, min: 0, max: 100, title: "Batt Voltage (V)" });
	new JustGage({ id: "gaugeBattCurrent", value: battData.current.slice(-1)[0] || 0, min: 0, max: 100, title: "Batt Current (A)" });
	new JustGage({ id: "gaugeBattPower", value: battData.power.slice(-1)[0] || 0, min: 0, max: 5000, title: "Batt Power (W)" });
	new JustGage({ id: "gaugeBattEnergy", value: battData.energy.slice(-1)[0] || 0, min: 0, max: 10000, title: "Batt Energy (kWh)" });

	// Chart Load
	new Chart(document.getElementById('chartLoad'), {
		type: 'line',
		data: {
			labels: labels,
			datasets: [
				{ label: 'Voltage (V)', data: loadData.voltage, borderColor: 'blue', fill: false },
				{ label: 'Current (A)', data: loadData.current, borderColor: 'red', fill: false },
				{ label: 'Power (W)', data: loadData.power, borderColor: 'green', fill: false },
				{ label: 'Energy (kWh)', data: loadData.energy, borderColor: 'orange', fill: false },
				{ label: 'Frequency (Hz)', data: loadData.frequency, borderColor: 'purple', fill: false },
				{ label: 'Power Factor', data: loadData.pf, borderColor: 'brown', fill: false }
			]
		}
	});

	// Chart PV
	new Chart(document.getElementById('chartPV'), {
		type: 'line',
		data: {
			labels: labels,
			datasets: [
				{ label: 'Voltage (V)', data: pvData.voltage, borderColor: 'blue', fill: false },
				{ label: 'Current (A)', data: pvData.current, borderColor: 'red', fill: false },
				{ label: 'Power (W)', data: pvData.power, borderColor: 'green', fill: false },
				{ label: 'Energy (kWh)', data: pvData.energy, borderColor: 'orange', fill: false }
			]
		}
	});

	// Chart Battery
	new Chart(document.getElementById('chartBatt'), {
		type: 'line',
		data: {
			labels: labels,
			datasets: [
			{ label: 'Voltage (V)', data: battData.voltage, borderColor: 'blue', fill: false },
			{ label: 'Current (A)', data: battData.current, borderColor: 'red', fill: false },
			{ label: 'Power (W)', data: battData.power, borderColor: 'green', fill: false },
			{ label: 'Energy (kWh)', data: battData.energy, borderColor: 'orange', fill: false }
		]
	}
});

// Auto-refresh setiap 5 detik untuk update data real-time
setTimeout(function(){
	location.reload();
}, 5000);
</script>
@endpush