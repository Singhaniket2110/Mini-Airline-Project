<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Flight Schedule - Skyward Airlines</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<style>
		.schedule-container {
			background: white;
			border-radius: 12px;
			padding: 30px;
			margin: 20px 0;
			box-shadow: 0 4px 15px rgba(0,0,0,0.1);
		}
		.schedule-filters {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
			gap: 20px;
			margin-bottom: 30px;
		}
		.filter-group {
			margin-bottom: 15px;
		}
		.filter-group label {
			display: block;
			margin-bottom: 8px;
			color: #7C444F;
		}
		.filter-group select, .filter-group input {
			width: 100%;
			padding: 10px;
			border: 2px solid rgba(124, 68, 79, 0.2);
			border-radius: 8px;
			background: rgba(243, 158, 96, 0.05);
		}
		.schedule-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}
		.schedule-table th {
			background: linear-gradient(135deg, #7C444F 0%, #9F5255 100%);
			color: white;
			padding: 15px;
			text-align: left;
		}
		.schedule-table td {
			padding: 12px 15px;
			border-bottom: 1px solid #eee;
		}
		.schedule-table tr:hover {
			background: rgba(124, 68, 79, 0.05);
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
			<a href="flight_schedule.php" class="active">Flight Schedule</a>
			<a href="travel_guide.php">Travel Guide</a>
			<a href="faq.php">FAQs</a>
		</nav>

		<div class="content">
			<h1><i class="fas fa-plane-departure"></i> Flight Schedule</h1>
			
			<div class="schedule-container">
				<div class="schedule-filters">
					<div class="filter-group">
						<label for="origin">From</label>
						<select id="origin" name="origin">
							<option value="">All Origins</option>
							<?php
							$origins = $conn->query("SELECT DISTINCT origin FROM flights ORDER BY origin");
							while($origin = $origins->fetch_assoc()) {
								echo "<option value='" . htmlspecialchars($origin['origin']) . "'>" 
									. htmlspecialchars($origin['origin']) . "</option>";
							}
							?>
						</select>
					</div>
					<div class="filter-group">
						<label for="destination">To</label>
						<select id="destination" name="destination">
							<option value="">All Destinations</option>
							<?php
							$destinations = $conn->query("SELECT DISTINCT destination FROM flights ORDER BY destination");
							while($destination = $destinations->fetch_assoc()) {
								echo "<option value='" . htmlspecialchars($destination['destination']) . "'>" 
									. htmlspecialchars($destination['destination']) . "</option>";
							}
							?>
						</select>
					</div>
					<div class="filter-group">
						<label for="date">Date</label>
						<input type="date" id="date" name="date">
					</div>
				</div>

				<table class="schedule-table">
					<thead>
						<tr>
							<th>Flight</th>
							<th>From</th>
							<th>To</th>
							<th>Date</th>
							<th>Time</th>
							<th>Available Seats</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql = "SELECT * FROM flights ORDER BY date, time";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . htmlspecialchars($row['flight_name']) . "</td>";
								echo "<td>" . htmlspecialchars($row['origin']) . "</td>";
								echo "<td>" . htmlspecialchars($row['destination']) . "</td>";
								echo "<td>" . htmlspecialchars($row['date']) . "</td>";
								echo "<td>" . htmlspecialchars($row['time']) . "</td>";
								echo "<td>" . htmlspecialchars($row['seats']) . "</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='6' style='text-align: center;'>No flights scheduled</td></tr>";
						}
						?>
					</tbody>
				</table>
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
</body>
</html>