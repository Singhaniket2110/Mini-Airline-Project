<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_name = $_POST["flight_name"];
    $origin = $_POST["origin"];
    $destination = $_POST["destination"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $user_id = $_SESSION['user_id'];

    // First check if flight exists
    $check_flight = "SELECT id FROM flights WHERE flight_name='$flight_name' AND origin='$origin' AND destination='$destination' AND date='$date' AND time='$time'";
    $result = $conn->query($check_flight);

    if ($result->num_rows > 0) {
        $flight = $result->fetch_assoc();
        $flight_id = $flight['id'];

        // Check if user already booked this flight
        $check_booking = "SELECT id FROM bookings WHERE user_id='$user_id' AND flight_id='$flight_id'";
        $booking_result = $conn->query($check_booking);

        if ($booking_result->num_rows == 0) {
            $sql = "INSERT INTO bookings (user_id, flight_id, booking_date) VALUES ('$user_id', '$flight_id', NOW())";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['booking_success'] = true;
                header("Location: view_ticket.php");
                exit();
            } else {
                $message = "Error booking flight: " . $conn->error;
                $message_type = 'error';
            }
        } else {
            $message = "You have already booked this flight!";
            $message_type = 'error';
        }
    } else {
        $message = "Flight not found with the provided details!";
        $message_type = 'error';
    }
}

// If there's an error, redirect back to user dashboard with error message
if ($message) {
    $_SESSION['booking_message'] = $message;
    $_SESSION['booking_message_type'] = $message_type;
    header("Location: user_dashboard.php");
    exit();
}
?>
