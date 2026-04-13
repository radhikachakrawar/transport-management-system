<?php
$connection = mysqli_connect('localhost', 'root', '', 'transportation_ms');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$msg = "";

if ($id && isset($_POST['submit'])) {
    $username = $_POST['username'];
    
    $total_km = $_POST['total_km'];
    $fuel_cost = $_POST['fuel_cost'];
    $extra_cost = $_POST['extra_cost'];
    $total_cost = $_POST['total_cost'];
    
    // Insert into tripcost table
    $sql1 = "INSERT INTO `tripcost`(`booking_id`, `username`, `total_km`, `fuel_cost`, `extra_cost`, `total_cost`) 
             VALUES ('$id', '$username', '$total_km', '$fuel_cost', '$extra_cost', '$total_cost')";
             
    $result1 = mysqli_query($connection, $sql1);

    if ($result1) {
        // Insert into bill table
        $sql2 = "INSERT INTO `bill`(`bill_id`, `username`, `total_km`, `fuel_cost`, `extra_cost`, `total_cost`) 
                 VALUES ('$id', '$username', '$total_km', '$fuel_cost', '$extra_cost', '$total_cost')";
        
        $result2 = mysqli_query($connection, $sql2);

        if ($result2) {
            $msg = "<script language='javascript'>
                        swal('Success!', 'Registration Completed!', 'success');
                    </script>";
        } else {
            die('Error in inserting into bill: ' . mysqli_error($connection));
        }
    } else {
        die('Error in inserting into tripcost: ' . mysqli_error($connection));
    }
} else {
    $msg = "Booking ID not provided or form not submitted.";
}
?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="sweetalert2/sweetalert2.css">
    <script src="sweetalert2/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <?php echo $msg; ?>
    
    <script>
        var timer = setTimeout(function() {
            window.location='bookingvlist.php'
        }, 1000);
    </script>
</body>
</html>
