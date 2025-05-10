--Create database
CREATE DATABASE IF NOT EXISTS
flight_management;

--Use the created database
USE flight_management;


--Create users table
CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL
);

--Create flights table
CREATE TABLE IF NOT EXISTS flights(
    id INT AUTO_INCREMENT PRIMARY KEY,
    flight_name VARCHAR(50) NOT NULL,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    seats INT NOT NULL,
    
);

--Create bookings table
CREATE TABLE IF NOT EXISTS bookings(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    flight_id INT NOT NULL,
    destination VARCHAR(100) NOT NULL,
    booking_date DATE NOT NULL,
    FOREIGN KEY(user_id) REFRENCES users(id)
    FOREIGN KEY(flight_id) REFRENCES flights(id)
    
);

