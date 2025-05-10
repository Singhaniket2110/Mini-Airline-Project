<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
$admin_id = $_SESSION['admin_id'];

$sql = "SELECT username FROM users WHERE id = $admin_id";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Flight Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: center;
        }
        .admin-header h1 {
            color: white;
            margin: 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .stat-card i {
            font-size: 2em;
            color: #3498db;
            margin-bottom: 10px;
        }
        .stat-card h3 {
            color: #2c3e50;
            margin: 10px 0;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
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
        border: none;
    }

    .theme-toggle:hover {
        background: #2980b9;
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
</style>
<body>
    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
        <i class="fas fa-moon"></i>
    </button>
    <div class="container">
        <div class="admin-header">
            <i class="fas fa-user-shield" style="font-size: 3em; margin-bottom: 15px;"></i>
            <h1>Welcome, <?php echo htmlspecialchars($admin['username']); ?></h1>
            <p>Flight Management System Administration</p>
        </div>

        <div class="dashboard">
            <a href="#" class="button" onclick="showSection('home')">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="#" class="button" onclick="showSection('addFlight')">
                <i class="fas fa-plus-circle"></i> Add Flights
            </a>
            <a href="#" class="button" onclick="showSection('removeFlight')">
                <i class="fas fa-minus-circle"></i> Remove Flights
            </a>
            <a href="#" class="button" onclick="showSection('listFlights')">
                <i class="fas fa-list"></i> List Flights
            </a>
            <a href="about.php" class="button">
                <i class="fas fa-info-circle"></i> About Us
            </a>
            <a href="logout.php" class="button" style="background: #e74c3c;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <div id="home" class="section">
            <h2><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-plane-departure"></i>
                    <h3>Total Flights</h3>
                    <?php
                    $flight_count = $conn->query("SELECT COUNT(*) as count FROM flights")->fetch_assoc()['count'];
                    echo "<p>$flight_count</p>";
                    ?>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>Total Users</h3>
                    <?php
                    $user_count = $conn->query("SELECT COUNT(*) as count FROM users WHERE role='user'")->fetch_assoc()['count'];
                    echo "<p>$user_count</p>";
                    ?>
                </div>
                <div class="stat-card">
                    <i class="fas fa-ticket-alt"></i>
                    <h3>Bookings</h3>
                    <?php
                    $booking_count = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'] ?? 0;
                    echo "<p>$booking_count</p>";
                    ?>
                </div>
            </div>
        </div>

        <div id="addFlight" class="section" style="display:none;">
            <h2><i class="fas fa-plus-circle"></i> Add New Flight</h2>
            <form action="add_flight.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="flight_name">Flight Name</label>
                        <input type="text" id="flight_name" name="flight_name" required>
                    </div>
                    <div class="form-group">
                        <label for="origin">Origin</label>
                        <input type="text" id="origin" name="origin" required>
                    </div>
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" id="destination" name="destination" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="seats">Available Seats</label>
                        <input type="number" id="seats" name="seats" required>
                    </div>
                </div>
                <button type="submit">
                    <i class="fas fa-plus"></i> Add Flight
                </button>
            </form>
        </div>

        <div id="removeFlight" class="section" style="display:none;">
            <h2><i class="fas fa-minus-circle"></i> Remove Flight</h2>
            <form action="remove_flight.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="flight_name">Flight Name</label>
                        <input type="text" id="flight_name" name="flight_name" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                </div>
                <button type="submit" style="background: #e74c3c;">
                    <i class="fas fa-trash-alt"></i> Remove Flight
                </button>
            </form>
        </div>

        <div id="listFlights" class="section" style="display:none;">
            <h2><i class="fas fa-list"></i> Available Flights</h2>
            <?php
            $sql = "SELECT * FROM flights";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div style='overflow-x: auto;'>";
                echo "<table>";
                echo "<tr>
                        <th>Flight Name</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Available Seats</th>
                    </tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["flight_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["origin"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["destination"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["seats"]) . "</td>";
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
