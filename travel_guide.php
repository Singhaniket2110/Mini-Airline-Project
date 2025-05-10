<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Travel Guide - Skyward Airlines</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<style>
		.travel-guide-container {
			max-width: 1200px;
			margin: 40px auto;
			padding: 20px;
			background: var(--bg-container);
			border-radius: 12px;
			box-shadow: 0 8px 30px var(--shadow-color);
		}
		.guide-section {
			background: var(--bg-container);
			padding: 25px;
			border-radius: 12px;
			margin-bottom: 30px;
			border: 1px solid var(--color-accent);
		}
		.guide-section h2 {
			color: var(--color-primary);
			margin-bottom: 20px;
		}
		.guide-section ul {
			list-style-type: none;
			padding-left: 0;
		}
		.guide-section li {
			margin-bottom: 15px;
			padding-left: 30px;
			position: relative;
			color: var(--text-primary);
		}
		.guide-section li i {
			position: absolute;
			left: 0;
			top: 4px;
			color: var(--color-accent);
		}
		.tip-box {
			background: var(--bg-container);
			border-left: 4px solid var(--color-accent);
			padding: 15px;
			margin: 20px 0;
			box-shadow: 0 2px 4px var(--shadow-color);
		}
		h1 {
			color: var(--color-primary);
		}
	</style>
</head>
<body>
	<button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
		<i class="fas fa-moon"></i>
	</button>
	
	<div class="travel-guide-container">
		<h1><i class="fas fa-map-marked-alt"></i> Travel Guide</h1>
		
		<div class="guide-section">
			<h2><i class="fas fa-plane-departure"></i> Pre-Flight Essentials</h2>
			<ul>
				<li><i class="fas fa-passport"></i> Keep your ID and boarding pass easily accessible</li>
				<li><i class="fas fa-clock"></i> Arrive at least 2 hours before international flights</li>
				<li><i class="fas fa-suitcase"></i> Check baggage restrictions and weight limits</li>
				<li><i class="fas fa-mobile-alt"></i> Download our mobile app for real-time updates</li>
			</ul>
		</div>

		<div class="guide-section">
			<h2><i class="fas fa-shield-alt"></i> Travel Safety Tips</h2>
			<ul>
				<li><i class="fas fa-exclamation-triangle"></i> Keep your belongings secure at all times</li>
				<li><i class="fas fa-hands-wash"></i> Regular sanitization of all aircraft</li>
				<li><i class="fas fa-temperature-high"></i> Health screening at check-in</li>
			</ul>
		</div>


		<div class="guide-section">
			<h2><i class="fas fa-luggage-cart"></i> Baggage Guidelines</h2>
			<ul>
				<li><i class="fas fa-weight"></i> Carry-on: 7kg max</li>
				<li><i class="fas fa-suitcase-rolling"></i> Checked baggage: 23kg per piece</li>
				<li><i class="fas fa-ban"></i> Prohibited items list available at check-in</li>
			</ul>
		</div>

		<div class="guide-section">
			<h2><i class="fas fa-concierge-bell"></i> In-Flight Services</h2>
			<ul>
				<li><i class="fas fa-utensils"></i> Complimentary meals on flights over 3 hours</li>
				<li><i class="fas fa-wifi"></i> Wi-Fi available on select flights</li>
				<li><i class="fas fa-film"></i> Entertainment system on international flights</li>
			</ul>
		</div>
	</div>

	<script>
		function toggleTheme() {
			const html = document.documentElement;
			const themeToggle = document.querySelector('.theme-toggle i');
			
			if (html.getAttribute('data-theme') === 'light') {
				html.setAttribute('data-theme', 'dark');
				themeToggle.className = 'fas fa-sun';
				localStorage.setItem('theme', 'dark');
			} else {
				html.setAttribute('data-theme', 'light');
				themeToggle.className = 'fas fa-moon';
				localStorage.setItem('theme', 'light');
			}
		}

		document.addEventListener('DOMContentLoaded', () => {
			const savedTheme = localStorage.getItem('theme') || 'light';
			const themeToggle = document.querySelector('.theme-toggle i');
			
			document.documentElement.setAttribute('data-theme', savedTheme);
			themeToggle.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
		});
	</script>

	<div class="footer">
		<div class="footer-content">
			<div class="footer-section">
				<h3>Contact Us</h3>
				<p><i class="fas fa-phone"></i>+91 9988776655</p>
				<p><i class="fas fa-envelope"></i> info@skywardairlines.com</p>
				<p><i class="fas fa-map-marker-alt"></i> 123 Aviation Way, Nariman Point,Mumbai</p>
			</div>
			
			<div class="footer-section">
				<h3>Quick Links</h3>
				<a href="about.php"><i class="fas fa-chevron-right"></i> About Us</a>
				<a href="flight_schedule.php"><i class="fas fa-chevron-right"></i> Flight Schedule</a>
				<a href="travel_guide.php"><i class="fas fa-chevron-right"></i> Travel Guide</a>
				<a href="faq.php"><i class="fas fa-chevron-right"></i> FAQs</a>
			</div>
			
			<div class="footer-section">
				<h3>Connect With Us</h3>
				<p>Follow us on social media for updates and offers</p>
				<div class="social-links">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
					<a href="#"><i class="fab fa-linkedin-in"></i></a>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<p>&copy; 2025 Skyward Airlines. All rights reserved.</p>
		</div>
	</div>
</body>
</html>