<?php
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
$sql= "SELECT * FROM `driver`";
$res=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicle Booking</title>
    <link href="index.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vehicle.css?v=1">

</head>

<body>
    <div class="navbar4-container">
        <?php include 'navbar4.php'; ?>
    </div>

    <div class="vehicle-booking">
        <div class="vehicle-nav">
            <ul>
                <li><a href="vehicle_booking.php">Home</a></li>
                <li><a href="vehicle-list.php" >Vehicle</a></li>
                <li><a href="driver-list.php">Driver</a></li>
                <li><a href="schedule.php">Schedule</a></li>
            </ul>
        </div>
        <div class="container">
      <?php
        if(mysqli_num_rows($res)>0){ ?>
      <div class="container">
         <div class="row">
             <div class="col-md-3"></div>
             <div class="col-md-6">
                 <div class="page-header">
                    <h1 class="animated tada" style="text-align: center;">Drive List</h1>      
                  </div> 
                  <table class="table foo">
                    <thead>
                        <th>Profile Picture</th>
                        <th>Driver Name</th>
                    </thead>  
                    <?php while($row=mysqli_fetch_assoc($res)) {  ?>
                    <tbody>
                        <tr>
                            <td><img height="100px" width="100px" src="picture/<?php echo $row["drphoto"]; ?>" alt="dp"></td>
                            <td><a href="driverprofile.php?driverid=<?php echo $row["driverid"]; ?>"> <?php echo $row["drname"] ?></a></td>
                        </tr>
                    </tbody> 
                <?php } }?>
                </table>
             </div>
             <div class="col-md-3"></div>
         </div>
          
      </div>    
   </div>
    </div> 
<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
<script>
        window.sr = ScrollReveal();
        sr.reveal('.foo', { duration: 800 });
    </script>
    </script> 
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>