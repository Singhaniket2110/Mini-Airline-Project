<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About Us - Airline Reservation System</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
	<button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
		<i class="fas fa-moon"></i>
	</button>
	<div class="container">
		<nav>
			<a href="index.php">Home</a>
			<?php if(isset($_SESSION['user_id'])): ?>
				<a href="user_dashboard.php">Dashboard</a>
				<a href="book_flight.php">Book Flight</a>
				<a href="logout.php">Logout</a>
			<?php elseif(isset($_SESSION['admin_id'])): ?>
				<a href="admin_dashboard.php">Admin Dashboard</a>
				<a href="logout.php">Logout</a>
			<?php else: ?>
				<a href="login_user.php">User Login</a>
				<a href="login_admin.php">Admin Login</a>
				<a href="register.php">Register</a>
			<?php endif; ?>
			<a href="about.php" class="active">About Us</a>
		</nav>
		
		<div class="content">
			<h1>About Us</h1>
			<div class="about-section">
				<h2>Welcome to Our Airline Reservation System</h2>
				<p>We are dedicated to providing a seamless and efficient flight booking experience for our customers. Our system offers:</p>
				<ul>
					<li>Easy flight booking and management</li>
					<li>Secure user accounts</li>
					<li>Real-time flight information</li>
					<li>24/7 customer support</li>
				</ul>
				<p>Our mission is to make air travel accessible and convenient for everyone. With years of experience in the aviation industry, we understand the importance of reliable and user-friendly booking systems.</p>
			</div>
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