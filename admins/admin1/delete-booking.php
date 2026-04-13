<?php
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: login.php');
//     exit();
// }

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'transportation_ms');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM logibookings WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Booking deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
header('Location: view-booking.php');
exit();
?>
