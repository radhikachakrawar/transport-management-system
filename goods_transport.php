<?php
ob_start();
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_loggedin']) || $_SESSION['user_loggedin'] !== true || !isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login-signup.php");
    exit();
}

// Database connection
$servername = "localhost";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goods and Logistics Service</title>
    <link href="index.css" rel="stylesheet" />
    <link rel="stylesheet" href="vehicle.css?v=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="navbar4-container">
        <?php include 'navbar4.php'; ?>
    </div>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to Our Goods and Logistics Service</h1>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sender_name = $_POST['sender_name'];
            $receiver_name = $_POST['receiver_name'];
            $pickup_add = isset($_POST['pickup_add']) ? $_POST['pickup_add'] : '';
            $receiver_add = isset($_POST['receiver_add']) ? $_POST['receiver_add'] : '';

            $goods_description = $_POST['goods_description'];
            $transport_date = $_POST['transport_date'];
            $status = 'Pending'; // Default status
        
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'transportation_ms');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO logibookings (sender_name, receiver_name, pickup_add, receiver_add, goods_description, status, transport_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $sender_name, $receiver_name, $pickup_add, $receiver_add, $goods_description, $status, $transport_date);


            if ($stmt->execute()) {
                // Set a session variable with the success message
                $_SESSION['message'] = "<div class='alert alert-success'>Booking successful!</div>";
            } else {
                // Set a session variable with the error message
                $_SESSION['message'] = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $conn->close();

            // Redirect to the same page to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        // Display the message after redirection
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            // Clear the message after displaying it
            unset($_SESSION['message']);
        }
        ?>


        <form action="goods_transport.php" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="sender_name">Sender Name:</label>
                <input type="text" class="form-control" id="sender_name" name="sender_name" required>
                <div class="invalid-feedback">Please enter the sender's name.</div>
            </div>
            <div class="form-group">
                <label for="receiver_name">Receiver Name:</label>
                <input type="text" class="form-control" id="receiver_name" name="receiver_name" required>
                <div class="invalid-feedback">Please enter the receiver's name.</div>
            </div>
            <div class="form-group">
                <label for="pickup_add">pickup Add:</label>
                <input type="text" class="form-control" id="pickup_add" name="pickup_add" required>
                <div class="invalid-feedback">Please enter the pickup Address.</div>
            </div>
            <div class="form-group">
                <label for="receiver_add">Receiver Address:</label>
                <input type="text" class="form-control" id="receiver_add" name="receiver_add" required>
                <div class="invalid-feedback">Please enter the receiver Address.</div>
            </div>
            <div class="form-group">
                <label for="goods_description">Goods Description:</label>
                <textarea class="form-control" id="goods_description" name="goods_description" required></textarea>
                <div class="invalid-feedback">Please enter a description of the goods.</div>
            </div>
            <div class="form-group">
                <label for="transport_date">Transport Date:</label>
                <input type="date" class="form-control" id="transport_date" name="transport_date" required>
                <div class="invalid-feedback">Please select a transport date.</div>
            </div>
            <button type="submit" class="btn btn-primary">Book Service</button>
        </form>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>
<?php
ob_end_flush(); // Flush the buffer and send output to the browser
?>