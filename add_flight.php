<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_name = $_POST["flight_name"];
    $origin = $_POST["origin"];
    $destination = $_POST["destination"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $seats = $_POST["seats"];

    $sql = "INSERT INTO flights (flight_name, origin, destination, date, time, seats) VALUES ('$flight_name', '$origin', '$destination', '$date', '$time', '$seats')";
    if ($conn->query($sql) === TRUE) {
        echo "Flight added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
