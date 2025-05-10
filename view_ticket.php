<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
	header("Location: login_user.php");
	exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT b.*, f.flight_name, f.origin, f.destination, f.date, f.time 
		FROM bookings b 
		JOIN flights f ON b.flight_id = f.id 
		WHERE b.user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View Tickets - Skyward Airlines</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<style>
		.ticket-container {
			margin: 20px 0;
		}
		.ticket {
			background: white;
			border-radius: 12px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.1);
			border-left: 5px solid #3498db;
		}
		.ticket-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 15px;
			padding-bottom: 15px;
			border-bottom: 1px solid #eee;
		}
		.ticket-details {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
			gap: 20px;
		}
		.detail-group {
			margin-bottom: 15px;
		}
		.detail-group label {
			display: block;
			color: #666;
			margin-bottom: 5px;
			font-size: 0.9em;
		}
		.detail-group span {
			font-weight: 500;
			color: #2c3e50;
		}
		.message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }
        .message.success {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border: 1px solid rgba(46, 204, 113, 0.2);
        }
        .message i {
            margin-right: 10px;
            font-size: 1.2em;
        }
		.no-tickets {
			text-align: center;
			padding: 40px;
			background: rgba(52, 152, 219, 0.1);
			border-radius: 12px;
			color: #2c3e50;
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
			<a href="user_dashboard.php">Dashboard</a>
			<a href="book_flight.php">Book Flight</a>
			<a href="view_ticket.php" class="active">View Tickets</a>
			<a href="about.php">About Us</a>
			<a href="logout.php">Logout</a>
		</nav>

		<div class="content">
            <?php if (isset($_SESSION['booking_success'])): ?>
                <div class="message success">
                    <i class="fas fa-check-circle"></i>
                    Flight booked successfully! Here are your ticket details.
                </div>
                <?php unset($_SESSION['booking_success']); ?>
            <?php endif; ?>
            
            <h1><i class="fas fa-ticket-alt"></i> Your Tickets</h1>
			
			<div class="ticket-container">
				<?php if ($result && $result->num_rows > 0): ?>
					<?php while($row = $result->fetch_assoc()): ?>
						<div class="ticket">
							<div class="ticket-header">
								<h3><i class="fas fa-plane"></i> <?php echo htmlspecialchars($row['flight_name']); ?></h3>
								<div class="booking-id">
									Booking ID: <?php echo htmlspecialchars($row['id']); ?>
								</div>
							</div>
							<div class="ticket-details">
								<div class="detail-group">
									<label>From</label>
									<span><?php echo htmlspecialchars($row['origin']); ?></span>
								</div>
								<div class="detail-group">
									<label>To</label>
									<span><?php echo htmlspecialchars($row['destination']); ?></span>
								</div>
								<div class="detail-group">
									<label>Date</label>
									<span><?php echo htmlspecialchars($row['date']); ?></span>
								</div>
								<div class="detail-group">
									<label>Time</label>
									<span><?php echo htmlspecialchars($row['time']); ?></span>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php else: ?>
					<div class="no-tickets">
						<i class="fas fa-ticket-alt" style="font-size: 3em; margin-bottom: 20px; color: #3498db;"></i>
						<h2>No Tickets Found</h2>
						<p>You haven't booked any flights yet.</p>
						<a href="book_flight.php" class="button" style="margin-top: 20px;">
							<i class="fas fa-plus"></i> Book a Flight
						</a>
					</div>
				<?php endif; ?>
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