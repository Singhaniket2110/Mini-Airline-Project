<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT username FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Flight Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }
        .dashboard .button {
            flex: 1;
            min-width: 200px;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dashboard .button i {
            margin-right: 10px;
            font-size: 1.2em;
        }
        .section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-top: 20px;
        }
        .welcome-header {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: center;
        }
        .welcome-header h1 {
            color: white;
            margin: 0;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .form-group input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
            outline: none;
        }
        table {
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        th {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 15px;
        }
        td {
            padding: 12px 15px;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .section h2 i {
            margin-right: 10px;
            color: #3498db;
        }
        .logout-btn {
            background: #e74c3c !important;
        }
        .logout-btn:hover {
            background: #c0392b !important;
        }
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }
        .message.error {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border: 1px solid rgba(231, 76, 60, 0.2);
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

        /* Footer Styles */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 40px 0 20px;
            margin-top: 50px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            padding: 0 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section h3 {
            color: #3498db;
            margin-bottom: 20px;
        }

        .footer-section p {
            margin-bottom: 10px;
        }

        .footer-section a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #3498db;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            background: #34495e;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .social-links a:hover {
            background: #3498db;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #34495e;
        }

        /* Theme Toggle Styles */
        [data-theme="dark"] {
            --bg-color: #1a1a1a;
            --text-color: #ffffff;
            --section-bg: #2c2c2c;
        }

        [data-theme="light"] {
            --bg-color: #ffffff;
            --text-color: #2c3e50;
            --section-bg: #ffffff;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .section {
            background-color: var(--section-bg);
        }

        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #3498db;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .theme-toggle:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="theme-toggle" onclick="toggleTheme()">
        <i class="fas fa-moon"></i>
    </div>
    <div class="container">
        <div class="welcome-header">
            <i class="fas fa-user-circle" style="font-size: 3em; margin-bottom: 15px;"></i>
            <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
            <p>Manage your flights and bookings</p>
        </div>

        <div class="dashboard">
            <a href="#" class="button" onclick="showSection('home')">
                <i class="fas fa-home"></i>Home
            </a>
            <a href="#" class="button" onclick="showSection('bookFlight')">
                <i class="fas fa-ticket-alt"></i>Book Flight
            </a>
            <a href="#" class="button" onclick="showSection('cancelFlight')">
                <i class="fas fa-ban"></i>Cancel Flight
            </a>
            <a href="#" class="button" onclick="showSection('viewFlights')">
                <i class="fas fa-plane"></i>View Flights
            </a>
            <a href="view_ticket.php" class="button">
                <i class="fas fa-ticket-alt"></i>View Tickets
            </a>
            <a href="about.php" class="button">
                <i class="fas fa-info-circle"></i>About Us
            </a>
            <a href="logout.php" class="button logout-btn">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </div>

        <div id="home" class="section">
            <h2><i class="fas fa-home"></i>Dashboard Overview</h2>
            <p>Welcome to your flight management dashboard. Here you can:</p>
            <ul style="list-style: none; padding: 0; margin-top: 20px;">
                <li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #3498db; margin-right: 10px;"></i>Book new flight tickets</li>
                <li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #3498db; margin-right: 10px;"></i>Cancel existing bookings</li>
                <li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #3498db; margin-right: 10px;"></i>View available flights</li>
                <li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #3498db; margin-right: 10px;"></i>View your booked tickets</li>
                <li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #3498db; margin-right: 10px;"></i>Manage your travel plans</li>
            </ul>
        </div>

        <?php if (isset($_SESSION['booking_message'])): ?>
            <div class="message <?php echo $_SESSION['booking_message_type']; ?>">
                <i class="fas <?php echo $_SESSION['booking_message_type'] == 'error' ? 'fa-exclamation-circle' : 'fa-check-circle'; ?>"></i>
                <?php 
                echo $_SESSION['booking_message'];
                unset($_SESSION['booking_message']);
                unset($_SESSION['booking_message_type']);
                ?>
            </div>
        <?php endif; ?>

        <div id="bookFlight" class="section" style="display:none;">
            <h2><i class="fas fa-ticket-alt"></i>Book Flight</h2>
            <form action="book_flight.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="flight_name">Flight Name</label>
                        <select id="flight_name" name="flight_name" required>
                            <option value="">Select Flight</option>
                            <?php
                            $flights_sql = "SELECT DISTINCT flight_name FROM flights";
                            $flights_result = $conn->query($flights_sql);
                            while($flight = $flights_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($flight['flight_name']) . "'>" . htmlspecialchars($flight['flight_name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="origin">Origin</label>
                        <select id="origin" name="origin" required>
                            <option value="">Select Origin</option>
                            <?php
                            $origins_sql = "SELECT DISTINCT origin FROM flights";
                            $origins_result = $conn->query($origins_sql);
                            while($origin = $origins_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($origin['origin']) . "'>" . htmlspecialchars($origin['origin']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <select id="destination" name="destination" required>
                            <option value="">Select Destination</option>
                            <?php
                            $destinations_sql = "SELECT DISTINCT destination FROM flights";
                            $destinations_result = $conn->query($destinations_sql);
                            while($destination = $destinations_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($destination['destination']) . "'>" . htmlspecialchars($destination['destination']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                </div>
                <button type="submit">
                    <i class="fas fa-paper-plane"></i> Book Flight
                </button>
            </form>
        </div>

        <div id="cancelFlight" class="section" style="display:none;">
            <h2><i class="fas fa-ban"></i>Cancel Flight</h2>
            <form action="cancel_flight.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="from">From</label>
                        <input type="text" id="from" name="from" required>
                    </div>
                    <div class="form-group">
                        <label for="to">To</label>
                        <input type="text" id="to" name="to" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                </div>
                <button type="submit" style="background: #e74c3c;">
                    <i class="fas fa-times-circle"></i> Cancel Flight
                </button>
            </form>
        </div>

        <div id="viewFlights" class="section" style="display:none;">
            <h2><i class="fas fa-plane"></i>Available Flights</h2>
            <?php
            $sql = "SELECT * FROM flights";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div style='overflow-x: auto;'>";
                echo "<table>";
                echo "<tr>
                        <th>Flight Name</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["flight_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["origin"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["destination"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p style='text-align: center; color: #666;'><i class='fas fa-info-circle'></i> No flights available at the moment.</p>";
            }
            ?>
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
        function showSection(section) {
            document.querySelectorAll('.section').forEach(el => el.style.display = 'none');
            document.getElementById(section).style.display = 'block';
        }

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

        // Check for saved theme preference
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const themeToggle = document.querySelector('.theme-toggle i');
            
            document.documentElement.setAttribute('data-theme', savedTheme);
            themeToggle.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        });
    </script>
</body>
</html>
