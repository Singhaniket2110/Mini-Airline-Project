# Mini Airline Management System

This is a **Mini Airline Management System** built using **PHP** and **MySQL**, designed to manage flight bookings, cancellations, and user/admin dashboards. The system includes login functionality, ticket viewing, travel guide information, and admin controls for managing flights.

## 📂 Project Structure



### ✈️ User Features

- `register.php`: New user registration form.
- `login_user.php`: User login page.
- `user_dashboard.php`: Dashboard showing booked flights and options.
- `book_flight.php`: Interface to book a flight.
- `cancel_flight.php`: Allows users to cancel booked flights.
- `view_ticket.php`: View and download booked ticket.
- `logout.php`: Ends user session.

### 🛠️ Admin Features

- `login_admin.php`: Admin login interface.
- `admin_dashboard.php`: Overview and controls for admin.
- `add_flight.php`: Add new flights to the system.
- `remove_flight.php`: Remove existing flights from the system.

### ⚙️ Backend & Config

- `db_connect.php`: Database connection file (MySQL).
- `styles.css`: CSS file using custom styles and color themes.
- `logout.php`: Common logout logic for both users and admins.

## 🖥️ Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP (Procedural)
- **Database**: MySQL
- **Server**: Apache (XAMPP/LAMP/WAMP)

## 🎯 Features

- User Registration & Login
- Admin Login & Dashboard
- Flight Booking and Cancellation
- Ticket Viewing and Management
- Admin-controlled Flight Management
- Travel Guide and FAQ Pages
- Session Management and Logout
- Responsive UI with clean styling

## ⚠️ Prerequisites

- PHP 7.x or above
- MySQL 5.x or above
- Apache Server (XAMPP/WAMP/LAMP)

## 🚀 Installation

1. Clone or download this repository.
2. Place the project folder in your `htdocs` (for XAMPP).
3. Import the SQL database using `phpMyAdmin`:
   - Create a new database (e.g., `airline_db`).
   - Import the provided `.sql` file (if any).
4. Update database credentials in `db_connect.php`.
5. Start Apache and MySQL from your local server manager.
6. Open `http://localhost/<project-folder>/` in your browser.

## 📌 Notes

- Make sure `session_start()` is used at the top of PHP files using session data.
- Protect admin/user pages with session-based access control.
- Sanitize and validate all user inputs for security.
- Future improvements could include payment integration, seat selection, and email notifications.

## 📄 License

This project is for educational/demo purposes only. Feel free to use or modify it for learning or college submissions.

---

