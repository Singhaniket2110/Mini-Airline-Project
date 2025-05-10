<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FAQs - Skyward Airlines</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<style>
		.faq-container {
			max-width: 800px;
			margin: 20px auto;
		}
		.faq-item {
			background: white;
			border-radius: 12px;
			margin-bottom: 20px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.1);
			overflow: hidden;
		}
		.faq-question {
			padding: 20px;
			cursor: pointer;
			display: flex;
			justify-content: space-between;
			align-items: center;
			color: #7C444F;
			font-weight: 500;
		}
		.faq-question i {
			transition: transform 0.3s ease;
		}
		.faq-answer {
			padding: 0 20px;
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.3s ease, padding 0.3s ease;
		}
		.faq-item.active .faq-answer {
			padding: 0 20px 20px;
			max-height: 500px;
		}
		.faq-item.active .faq-question i {
			transform: rotate(180deg);
		}
		.faq-categories {
			display: flex;
			gap: 15px;
			margin-bottom: 30px;
			flex-wrap: wrap;
		}
		.category-btn {
			padding: 8px 15px;
			border: none;
			border-radius: 20px;
			background: #f0f0f0;
			color: #7C444F;
			cursor: pointer;
			transition: all 0.3s ease;
		}
		.category-btn:hover, .category-btn.active {
			background: #7C444F;
			color: white;
		}
	</style>
</head>
<body>
	<button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
		<i class="fas fa-moon"></i>
	</button>
	<div class="container">
		<nav>
			<a href="index.php">Home</a>
			<a href="about.php">About Us</a>
			<a href="flight_schedule.php">Flight Schedule</a>
			<a href="travel_guide.php">Travel Guide</a>
			<a href="faq.php" class="active">FAQs</a>
		</nav>

		<div class="content">
			<h1><i class="fas fa-question-circle"></i> Frequently Asked Questions</h1>
			
			<div class="faq-categories">
				<button class="category-btn active" data-category="all">All</button>
				<button class="category-btn" data-category="booking">Booking</button>
				<button class="category-btn" data-category="baggage">Baggage</button>
				<button class="category-btn" data-category="services">Services</button>
			</div>

			<div class="faq-container">
				<div class="faq-item" data-category="booking">
					<div class="faq-question">
						How can I book a flight?
						<i class="fas fa-chevron-down"></i>
					</div>
					<div class="faq-answer">
						<p>You can book a flight through our website by following these steps:</p>
						<ol>
							<li>Create an account or log in</li>
							<li>Select your origin and destination</li>
							<li>Choose your travel dates</li>
							<li>Select your preferred flight</li>
							<li>Complete the payment process</li>
						</ol>
					</div>
				</div>

				<div class="faq-item" data-category="booking">
					<div class="faq-question">
						What payment methods do you accept?
						<i class="fas fa-chevron-down"></i>
					</div>
					<div class="faq-answer">
						<p>We accept various payment methods including:</p>
						<ul>
							<li>Credit/Debit Cards (Visa, MasterCard, American Express)</li>
							<li>PayPal</li>
							<li>Bank Transfer</li>
							<li>Digital Wallets</li>
						</ul>
					</div>
				</div>

				<div class="faq-item" data-category="baggage">
					<div class="faq-question">
						What is your baggage allowance?
						<i class="fas fa-chevron-down"></i>
					</div>
					<div class="faq-answer">
						<p>Our standard baggage allowance includes:</p>
						<ul>
							<li>Carry-on: 7kg (15.4 lbs)</li>
							<li>Checked baggage: 23kg (50.7 lbs)</li>
							<li>Additional baggage can be purchased during booking</li>
						</ul>
					</div>
				</div>

				<div class="faq-item" data-category="services">
					<div class="faq-question">
						Do you offer special assistance?
						<i class="fas fa-chevron-down"></i>
					</div>
					<div class="faq-answer">
						<p>Yes, we offer special assistance for:</p>
						<ul>
							<li>Passengers with reduced mobility</li>
							<li>Unaccompanied minors</li>
							<li>Pregnant passengers</li>
							<li>Elderly passengers</li>
						</ul>
						<p>Please request assistance at least 48 hours before your flight.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

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

	<script>
		// Theme Toggle
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

			// FAQ Functionality
			const faqItems = document.querySelectorAll('.faq-item');
			faqItems.forEach(item => {
				item.querySelector('.faq-question').addEventListener('click', () => {
					item.classList.toggle('active');
				});
			});

			// Category Filter
			const categoryBtns = document.querySelectorAll('.category-btn');
			categoryBtns.forEach(btn => {
				btn.addEventListener('click', () => {
					// Remove active class from all buttons
					categoryBtns.forEach(b => b.classList.remove('active'));
					// Add active class to clicked button
					btn.classList.add('active');
					
					const category = btn.dataset.category;
					faqItems.forEach(item => {
						if (category === 'all' || item.dataset.category === category) {
							item.style.display = 'block';
						} else {
							item.style.display = 'none';
						}
					});
				});
			});
		});
	</script>
</body>
</html>