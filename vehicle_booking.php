<?php
session_start();

if (
    (!isset($_SESSION['user_loggedin']) || $_SESSION['user_loggedin'] !== true)
    && 
    (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true)
) {
    header("Location: login-signup.php");
    exit();
}


// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "transportation_ms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicle Booking</title>
    <link href="index.css" rel="stylesheet" />
    <link rel="stylesheet" href="vehicle.css?v=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="navbar4-container">
        <?php include 'navbar4.php'; ?>
    </div>

    <div class="vehicle-booking">
        <div class="vehicle-nav">
            <ul>
                <li><a href="vehicle_booking.php">Home</a></li>
                <li><a href="vehicle-list.php">Vehicle</a></li>
                <li><a href="driver-list.php">Driver</a></li>
                <li><a href="schedule.php">Schedule</a></li>
            </ul>
        </div>
        <div class="vehicle-home">

            <h1>Transportaion MS</h1>
            <span class="home1">
            <div class="typewriter">
                <p>Efficiently manage your transportation needs with our comprehensive<br> Transportation Management System. <br>From ticket booking to vehicle reservations and goods transportation,<br> we have you covered.</p>
            </div>
            </span>
            <div class="book-btn"> <button type="button" class="btn btn-danger "><a href="bookingv.php">Book Vehicle</a></button></div>
           
           

        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>