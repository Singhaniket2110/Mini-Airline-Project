<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $date = $_POST["date"];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM bookings WHERE user_id='$user_id' AND flight_id IN (SELECT id FROM flights WHERE origin='$from' AND destination='$to' AND date='$date')";
    if ($conn->query($sql) === TRUE) {
        echo "Flight ticket cancelled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
