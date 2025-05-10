<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_name = $_POST["flight_name"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $sql = "DELETE FROM flights WHERE flight_name='$flight_name' AND date='$date' AND time='$time'";
    if ($conn->query($sql) === TRUE) {
        echo "Flight removed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
