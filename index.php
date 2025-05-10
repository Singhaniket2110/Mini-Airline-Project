<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyward Airlines - Flight Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .features {
            margin-top: 60px;
        }
        .feature-card {
            background: rgba(124, 68, 79, 0.05);
            padding: 25px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(124, 68, 79, 0.1);
        }
        .feature-card i {
            font-size: 2.5em;
            color: #E16A54;
            margin-bottom: 15px;
        }
        .feature-card h3 {
            color: #7C444F;
            margin: 15px 0;
        }
        .feature-card p {
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
                <i class="fas fa-circle" style="position: absolute; font-size: 0.8em; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.2;"></i>
            </div>
            <h1 class="logo-text">Skyward Airlines</h1>
            <p class="logo-tagline">"Seamless Skies, Smarter Flights - Your Journey, Our Priority!"</p>
        </div>

        <div class="login-options" style="margin-top: 40px;">
            <a href="login_user.php" class="button">
                <i class="fas fa-user"></i>
                Login as User
            </a>
            <a href="login_admin.php" class="button">
                <i class="fas fa-user-shield"></i>
                Login as Admin
            </a>
            <a href="register.php" class="button">
                <i class="fas fa-user-plus"></i>
                Register
            </a>
            <a href="about.php" class="button">
                <i class="fas fa-info-circle"></i>
                About Us
            </a>
        </div>

        <div class="features">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div class="feature-card">
                    <i class="fas fa-ticket-alt"></i>
                    <h3>Easy Booking</h3>
                    <p>Book your flights with just a few clicks</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clock"></i>
                    <h3>24/7 Service</h3>
                    <p>Round-the-clock flight management</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Secure System</h3>
                    <p>Safe and secure booking platform</p>
                </div>
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
           
    <p>Designed, Developed & Created by  
        <a href="https://github.com/Singhaniket2110" target="_blank">Aniket</a> &  
        <a href="https://github.com/RahulNag502" target="_blank">Rahul</a> 
        <span class="heart">❤️</span>
    </p>



        </div>
    </div>
</body>
</html>
