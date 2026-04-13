<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_loggedin']) || $_SESSION['user_loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: login-signup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking</title>
    <link href="index.css" rel="stylesheet" />
    <link href="booking.css?v=1" rel="stylesheet" />

  
</head>

<body>
   

    <div class="navbar4-container">
        <?php include 'navbar4.php'; ?>
    </div>

    <DIV class="booking_container">
        <div class="booking_head">
        <div class="bus_booking" onclick="loadBookingForm('bus_booking')">
                Bus Booking
            </div>
        </div>
        <div class="Booking_form" id="Booking_form">
        <?php include "bookings/bus_booking.php"; ?>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script>
       function loadBookingForm(type) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'bookings/' + type + '.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('Booking_form').innerHTML = this.responseText;
        } else {
            console.error('Failed to load content');
        }
    };
    xhr.onerror = function() {
        console.error('Network error occurred');
    };
    xhr.send();
}

    </script>
</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "transportation_ms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$conn->close();
?>
