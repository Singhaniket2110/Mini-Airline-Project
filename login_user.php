<?php
session_start();
include 'db_connect.php';

$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: user_dashboard.php");
            exit();
        }
    }
    $error_message = "Invalid username or password!";
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Skyward Airlines</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .error-message {
            background-color: rgba(124, 68, 79, 0.1);
            color: #7C444F;
            padding: 12px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
            border: 1px solid rgba(124, 68, 79, 0.2);
        }
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9F5255;
            font-size: 1.2em;
        }
        .input-group input {
            padding-left: 45px !important;
            background: rgba(243, 158, 96, 0.05);
            border: 2px solid rgba(159, 82, 85, 0.2);
        }
        .input-group input:focus {
            border-color: #E16A54;
            box-shadow: 0 0 0 3px rgba(225, 106, 84, 0.1);
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            margin-top: 25px;
            color: #9F5255;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .back-link:hover {
            color: #E16A54;
            transform: translateX(-5px);
        }
        .back-link i {
            margin-right: 8px;
        }
        .login-container {
            background: linear-gradient(135deg, #7C444F 0%, #9F5255 100%);
            padding: 2px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .login-inner {
            background: white;
            border-radius: 10px;
            padding: 30px;
        }
        .header i {
            color: #E16A54 !important;
        }
        .header h1 {
            color: #7C444F;
        }
        .header p {
            color: #9F5255;
        }
    </style>
</head>
<body>
    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
        <i class="fas fa-moon"></i>
    </button>
    <div class="container">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-plane"></i>
            </div>
            <h1 class="logo-text">Skyward Airlines</h1>
            <p class="logo-tagline">"Seamless Skies, Smarter Flights - Your Journey, Our Priority!"</p>
        </div>

        <div class="login-container">
            <div class="login-inner">
                <div class="header">
                    <i class="fas fa-user-circle" style="font-size: 3.5em; margin-bottom: 20px;"></i>
                    <h1>User Login</h1>
                    <p>Access your Skyward account</p>
                </div>

                <?php if ($error_message): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form action="login_user.php" method="POST" style="max-width: 400px; margin: 0 auto;">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <button type="submit" style="background: linear-gradient(135deg, #E16A54 0%, #9F5255 100%);">
                        <i class="fas fa-sign-in-alt"></i>
                        Login to Dashboard
                    </button>
                </form>
            </div>
        </div>

        <a href="index.php" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>
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

        // Check for saved theme preference
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
