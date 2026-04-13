<?php
session_start();
// Check if the admin is logged in, if not redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: http://localhost/Transportation%20MS/admins/login.php');
    exit;
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bus_name = $_POST['bus_name'];
    $departure_city = $_POST['departure_city'];
    $arrival_city = $_POST['arrival_city'];
    $departing_date = $_POST['departing_date'];
    $returning_date = $_POST['returning_date'];
    $bus_type = $_POST['bus_type'];
    $seats_available = $_POST['seats_available'];

    $sql = "INSERT INTO buses (bus_name, departure_city, arrival_city, departing_date, returning_date, bus_type, seats_available) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $bus_name, $departure_city, $arrival_city, $departing_date, $returning_date, $bus_type, $seats_available);

    if ($stmt->execute()) {
        $success_message = "Bus added successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Bus | Bootstrap Simple Admin Template</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="assets/img/tms.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#ticketbookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-ticket"></i>  Ticket Booking</a>
                    <ul class="collapse list-unstyled" id="ticketbookingmenu">
                        <li>
                            <a href="#busbookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fas fa-bus"></i> Bus Booking</a>
                            <ul class="collapse list-unstyled" id="busbookingmenu">
                                <li>
                                    <a href="bus_route.php">Bus & Routes</a>
                                </li>
                                <li>
                                    <a href="admin-add-bus.php">Add Buses</a>
                                </li>
                                <li>
                                    <a href="admin-booking-list.php">Booking List</a>
                                </li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                </li>
                <li>
                    <a href="#vehiclebookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck"></i>  Vehicle Booking</a>
                    <ul class="collapse list-unstyled" id="vehiclebookingmenu">
                        
                        <li>
                            <a href="newvehicle.php"> Add New Vehicle</a>
                        </li>
                        <li>
                            <a href="newdriver.php"> Add New Driver</a>
                        </li>
                        <li>
                            <a href="bill.php"> Billing</a>
                        </li>
                        <li>
                            <a href="bookingvlist.php"> Booking </a>
                        </li>
                        <li>
                            <a href="tripdetail.php"> Trip details</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#goods-logistics" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck-fast"></i>  Goods & Logistics</a>
                    <ul class="collapse list-unstyled" id="goods-logistics">
                        
                        <li>
                            <a href="view-booking.php"> View Bookings</a>
                        </li>
                        <li>
                            <a href="manage-billing.php"> Mange Billing</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="users.php"><i class="fas fa-user-friends"></i>Users</a>
                </li>
                <li>
                    <a href="adminlist.php"><i class="fas fa-user-shield"></i>Admin</a>
                </li>
            </ul>
        </nav>
        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                               
                               
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span><?php echo $_SESSION['admin_username']; ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i> Profile</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="http://localhost/Transportation%20MS/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Add Bus</h3>
                    </div>
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <div class="box box-primary">
                        <div class="box-body">
                            <form method="post" action="admin-add-bus.php">
                                <div class="form-group">
                                    <label for="bus_name">Bus Name</label>
                                    <input type="text" class="form-control" id="bus_name" name="bus_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="departure_city">Departure City</label>
                                    <input type="text" class="form-control" id="departure_city" name="departure_city"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="arrival_city">Arrival City</label>
                                    <input type="text" class="form-control" id="arrival_city" name="arrival_city"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="departing_date">Departing Date</label>
                                    <input type="date" class="form-control" id="departing_date" name="departing_date"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="returning_date">Returning Date</label>
                                    <input type="date" class="form-control" id="returning_date" name="returning_date">
                                </div>
                                <div class="form-group">
                                    <label for="bus_type">Bus Type</label>

                                    <select class="form-control" name="bus_type" id="bus_type" required>
                                        <option value="Standard">Standard</option>
                                        <option value="Deluxe">Deluxe</option>
                                        <option value="Luxury">Luxury</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="seats_available">Seats Available</label>
                                    <input type="number" class="form-control" id="seats_available"
                                        name="seats_available" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Bus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>