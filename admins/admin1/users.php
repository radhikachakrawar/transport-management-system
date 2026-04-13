<?php

session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: http://localhost/Transportation%20MS/admins/login.php");
    exit();
}
// db_connection.php
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


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Users | Bootstrap Simple Admin Template</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <a href="#ticketbookingmenu" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle no-caret-down"><i class="fa-solid fa-ticket"></i> Ticket Booking</a>
                    <ul class="collapse list-unstyled" id="ticketbookingmenu">
                        <li>
                            <a href="#busbookingmenu" data-bs-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle no-caret-down"><i class="fas fa-bus"></i> Bus Booking</a>
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
                    <a href="#vehiclebookingmenu" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck"></i> Vehicle Booking</a>
                    <ul class="collapse list-unstyled" id="vehiclebookingmenu">

                        <li>
                            <a href="newvehicle.php"><i class="fas fa-bus"></i> Add New Vehicle</a>
                        </li>
                        <li>
                            <a href="newdriver.php"><i class="fas fa-train"></i> Add New Driver</a>
                        </li>
                        <li>
                            <a href="bill.php"><i class="fas fa-plane"></i> Billing</a>
                        </li>
                        <li>
                            <a href="bookingvlist.php"><i class="fas fa-bus"></i> Booking </a>
                        </li>
                        <li>
                            <a href="tripdetail.php"><i class="fas fa-train"></i> Trip details</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#goods-logistics" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck-fast"></i> Goods &
                        Logistics</a>
                    <ul class="collapse list-unstyled" id="goods-logistics">

                        <li>
                            <a href="view-booking.php"><i class="fas fa-bus"></i> View Bookings</a>
                        </li>
                        <li>
                            <a href="manage-billing.php"><i class="fas fa-train"></i> Mange Billing</a>
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
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span><?php echo $_SESSION['admin_username']; ?></span> <i
                                        style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i>
                                                Profile</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                                        </li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="http://localhost/Transportation%20MS/logout.php"
                                                class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                        </li>
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
                        <h3>Users
                           
                        </h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT id, name, email, role FROM users";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["role"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No users found</td></tr>";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>