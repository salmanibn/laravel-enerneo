
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About | EnerNeo Monitoring</title>
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
	<style>
			   .header-login-link {
				   color: #fff;
				   text-decoration: none;
				   font-weight: 500;
				   padding: 0.5rem 1.2rem;
				   border-radius: 8px;
				   transition: background 0.2s, color 0.2s;
			   }
			   .header-login-link:hover {
				   background: #00BCD4;
				   color: #181818;
			   }
		body {
			background: #111;
			color: #fff;
			font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
			margin: 0;
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}
		.hero-container {
	
			border-radius: 2rem;
			padding: 3rem 2rem;
			width: 80%;
			height: 100px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			margin-top: 90px;
		}
		.hero-title {
			font-size: 2.5rem;
			font-weight: bold;
			margin-bottom: 1.5rem;
			letter-spacing: 1px;
			text-align: center;
		}
		.hero-desc {
			font-size: 1.15rem;
			color: #e0e0e0;
			text-align: center;
            margin-top: 60px;
			margin-bottom: 1.5rem;
		}
		.hero-logo {
			width: 90px;
			height: 90px;
			border-radius: 50%;
			margin-bottom: 1.5rem;
			margin-top: 2rem;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 2px 12px rgba(0,0,0,0.12);
		}
		.hero-logo img {
			width: 280x;
			height: 280px;
			object-fit: contain;
		}
	</style>
</head>
<body>
	<header style="position:fixed;top:0;left:0;width:100%;height:70px;background:#181818;color:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 2.5rem;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
		<div style="display:flex;align-items:center;gap:1rem;">
			   <a href="/">
				   <img src="/icon/ENERNEO-H.png" alt="EnerNeo Logo" style="width:160px;height:120px;object-fit:cover;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
			   </a>
		</div>
		<nav style="display:flex;align-items:center;gap:2rem;margin-right:4rem;">
			   <a href="{{ route('login') }}" class="header-login-link">Login</a>
		</nav>
	</header>
	<div class="hero-container" style="margin-top:2px;min-height:1300px;">
		<div class="hero-logo">
			<img src="/icon/logo-enerneo.png" alt="EnerNeo Logo">
		</div>

		<div class="hero-desc">
			Sistem monitoring energi untuk efisiensi dan kemudahan pengawasan.<br>
			Pantau konsumsi energi secara real-time, analisis data, dan tingkatkan efisiensi operasional Anda bersama EnerNeo.
		</div>

        <!-- Produk dan Paket Section -->
		<section style="width:100%;max-width:1100px;margin:40px auto 0 auto;">
			<div style="background:#00BCD4;color:#fff;padding:1.2rem 0 1.2rem 2rem;font-size:2rem;font-weight:700;letter-spacing:1px;border-radius:18px;">PRODUK DAN PAKET</div>
			<div class="product-grid">
				<!-- BASIC -->
				<div class="product-card">
					<div style="font-size:1.3rem;font-weight:700;letter-spacing:1px;margin-bottom:0.5rem;">BASIC</div>
					<div style="font-size:2rem;font-weight:700;color:#00BCD4;">RP 50K<span style="font-size:1rem;font-weight:400;color:#fff;">/BULAN</span></div>
					<ul style="margin:1.2rem 0 1.2rem 1.2rem;padding:0;font-size:1rem;line-height:1.7;">
						<li>Pemantauan Real-time</li>
						<li>Tampilan sederhana</li>
						<li>Ekonomis</li>
					</ul>
					<div style="color:#00BCD4;font-weight:700;margin-bottom:0.2rem;">Biaya Alat & Pemasangan</div>
					<div style="font-size:1rem;">RP 450k</div>
				</div>
				<!-- STANDARD -->
				<div class="product-card">
                    <div style="font-size:1.3rem;font-weight:700;letter-spacing:1px;margin-bottom:0.5rem;">STANDARD</div>
					<div style="font-size:2rem;font-weight:700;color:#00BCD4;">RP 80K<span style="font-size:1rem;font-weight:400;color:#fff;">/BULAN</span></div>
					<ul style="margin:1.2rem 0 1.2rem 1.2rem;padding:0;font-size:1rem;line-height:1.7;">
						<li>Pemantauan Real-time</li>
						<li>Tampilan Interaktif</li>
						<li>Riwayat Data Harian</li>
						<li>Analisis Performa</li>
					</ul>
					<div style="color:#00BCD4;font-weight:700;margin-bottom:0.2rem;">Biaya Alat & Pemasangan</div>
					<div style="font-size:1rem;">RP 850k</div>
				</div>
				<!-- ADVANCED -->
				<div class="product-card">
					<div style="font-size:1.3rem;font-weight:700;letter-spacing:1px;margin-bottom:0.5rem;">ADVANCED</div>
					<div style="font-size:2rem;font-weight:700;color:#00BCD4;">RP 100K<span style="font-size:1rem;font-weight:400;color:#fff;">/BULAN</span></div>
					<ul style="margin:1.2rem 0 1.2rem 1.2rem;padding:0;font-size:1rem;line-height:1.7;">
						<li>Pemantauan Real-Time</li>
						<li>Tampilan Penuh + Grafik</li>
						<li>Riwayat Data Harian</li>
						<li>Analisis Lengkap Performa</li>
						<li>Layanan Bantuan Teknis</li>
					</ul>
					<div style="color:#00BCD4;font-weight:700;margin-bottom:0.2rem;">Biaya Alat & Pemasangan</div>
					<div style="font-size:1rem;">RP 1300k</div>
				</div>
			</div>
            
		</section>
		<style>
			.product-grid {
				background:#111;
				padding:2.5rem 1rem 2.5rem 1rem;
				border-radius:0 0 18px 18px;
				display: grid;
				grid-template-columns: 1fr;
				gap: 2rem;
				justify-content: center;
				align-items: flex-start;
			}
			.product-card {
				border:4px solid #00BCD4;
				border-radius:18px;
				padding:2rem 1.5rem;
				background:#181818;
				color:#fff;
				display:flex;
				flex-direction:column;
				align-items:flex-start;
				width:100%;
				max-width:300px;
				margin:0 auto;
				min-height:370px;
				height:370px;
				box-sizing:border-box;
			}
			@media (min-width: 1200px) {
				.product-grid {
					grid-template-columns: repeat(3, 1fr);
				}
			}
			@media (max-width: 600px) {
				.product-grid {
					grid-template-columns: 1fr;
				}
			}
		</style>
		<!-- Contact Section -->
		<div style="margin:40px auto 0 auto;width:100%;max-width:1100px;background:#181818;border-radius:40px;padding:2rem 1.5rem;color:#fff;box-shadow:0 2px 12px rgba(0,0,0,0.10);">
			<div style="font-size:1.15rem;margin-bottom:1.2rem;text-align:center;">
				Berminat dengan produk kami? Hubungi kami di:
			</div>
			<div style="">
				<div class="contact-buttons-row">
					<a href="https://instagram.com/enerneo.id" target="_blank" class="contact-btn instagram-btn" style="background: linear-gradient(90deg, #405DE6 0%, #833AB4 100%);">
						<span style="font-weight:600;">Instagram:</span> @enerneo.id
					</a>
					<a href="https://wa.me/6282221677778?text=Halo%2C%20Saya%20berminat%20dengan%20produk%20EnerNeo." target="_blank" class="contact-btn whatsapp-btn">
						<span style="font-weight:600;">WhatsApp:</span> +62 822-2167-7778
					</a>
				</div>
				<style>
					.contact-buttons-row {
						display: flex;
						gap: 1.2rem;
						justify-content: center;
						align-items: stretch;
						margin-bottom: 0.2rem;
						flex-wrap: wrap;
					}
					.contact-btn {
						display: block;
						background: #00BCD4;
						color: #fff;
						text-decoration: none;
						font-weight: 600;
						padding: 0.9rem 1.5rem;
						border-radius: 20px;
						transition: background 0.2s, color 0.2s;
						box-shadow: 0 2px 8px rgba(0,188,212,0.10);
						font-size: 1.1rem;
						min-width: 210px;
						text-align: center;
						margin-bottom: 0;
					}
					.whatsapp-btn {
						background: #25D366;
						box-shadow: 0 2px 8px rgba(37,211,102,0.10);
					}
					.instagram-btn {
						background: linear-gradient(90deg, #405DE6 0%, #833AB4 100%) !important;
					}
					.instagram-btn:hover {
						filter: brightness(0.92);
						color: #fff !important;
					}
					.whatsapp-btn:hover {
						background: #128C7E !important;
						color: #fff !important;
					}
					@media (max-width: 600px) {
						.contact-buttons-row {
							flex-direction: column;
							gap: 0.7rem;
						}
						.contact-btn {
							min-width: 0;
						}
					}
				</style>
			</div>
		</div>
	</div>
	<footer style="width:100vw;background:#181818;color:#fff;text-align:center;padding:1rem 0;position:fixed;bottom:0;left:0;z-index:99;box-shadow:0 -2px 8px rgba(0,0,0,0.08);">
		&copy; {{ date('Y') }} EnerNeo. All rights reserved.
	</footer>
</body>
</html>
