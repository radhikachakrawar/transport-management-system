<?php
    $connection = mysqli_connect("localhost:3307", "root", "", "transportation_ms");

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    session_start();

    $row = null; // Define $row with a default value

    if (isset($_GET['id'])) { // Use $_GET to retrieve the ID from the URL
        $id = $_GET['id'];

        $sql = "SELECT * FROM `booking` WHERE booking_id='$id'";
        $res = mysqli_query($connection, $sql);

        if (!$res) {
            die("Query failed: " . mysqli_error($connection));
        }

        $row = mysqli_fetch_assoc($res);

        if ($row) {
            $sql1 = "SELECT * FROM `vehicle` WHERE veh_available='0'";
            $res1 = mysqli_query($connection, $sql1);

            if (!$res1) {
                die("Query failed: " . mysqli_error($connection));
            }

            $sql2 = "SELECT * FROM `driver` WHERE dr_available='0'";
            $res2 = mysqli_query($connection, $sql2);

            if (!$res2) {
                die("Query failed: " . mysqli_error($connection));
            }
        } else {
            echo "No booking found with the given ID.";
            exit;
        }
    } else {
        echo "ID not provided.";
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Booking</title>
    
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .booking-details {
            margin-top: 20px;
        }
        .booking-details .table th,
        .booking-details .table td {
            vertical-align: middle;
        }
        .booking-details .table th {
            width: 30%;
        }
        .input-group-addon {
            width: 150px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <nav id="sidebar" class="active">
        <div class="sidebar-header">
            <img src="assets/img/tms.png" alt="bootraper logo" class="app-logo">
        </div>
        <ul class="list-unstyled components text-secondary">
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li>
                <a href="#ticketbookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-ticket"></i> Ticket Booking</a>
                <ul class="collapse list-unstyled" id="ticketbookingmenu">
                    <li>
                        <a href="#busbookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fas fa-bus"></i> Bus Booking</a>
                        <ul class="collapse list-unstyled" id="busbookingmenu">
                            <li><a href="bus_route.php">Bus & Routes</a></li>
                            <li><a href="admin-add-bus.php">Add Buses</a></li>
                            <li><a href="admin-booking-list.php">Booking List</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#vehiclebookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck"></i> Vehicle Booking</a>
                <ul class="collapse list-unstyled" id="vehiclebookingmenu">
                    <li><a href="newvehicle.php">Add New Vehicle</a></li>
                    <li><a href="newdriver.php">Add New Driver</a></li>
                    <li><a href="bill.php">Billing</a></li>
                    <li><a href="bookingvlist.php">Booking</a></li>
                    <li><a href="tripdetail.php">Trip details</a></li>
                </ul>
            </li>
            <li>
                <a href="#goods-logistics" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck-fast"></i> Goods & Logistics</a>
                <ul class="collapse list-unstyled" id="goods-logistics">
                    <li><a href="view-booking.php">View Bookings</a></li>
                    <li><a href="manage-billing.php">Manage Billing</a></li>
                </ul>
            </li>
            <li><a href="users.php"><i class="fas fa-user-friends"></i>Users</a></li>
            <li><a href="adminlist.php"><i class="fas fa-user-shield"></i>Admin</a></li>
        </ul>
    </nav>
    <div id="body" class="active">
        <nav class="navbar navbar-expand-lg navbar-white bg-white">
            <button type="button" id="sidebarCollapse" class="btn btn-light">
                <i class="fas fa-bars"></i><span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <div class="nav-dropdown"></div>
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
                                    <li><a href="http://localhost:3307/Transportation%20MS/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container booking-details">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="page-header">
                        <h1 class="text-center">Confirm Booking</h1>
                    </div>
                    <?php if ($row): ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Booking Id:</th>
                                    <td><?php echo $row['booking_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Customer Name:</th>
                                    <td><?php echo $row['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pickup Date:</th>
                                    <td><?php echo $row['pic_date']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pickup Time:</th>
                                    <td><?php echo $row['pic_time']; ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Date:</th>
                                    <td><?php echo $row['dil_date']; ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Time:</th>
                                    <td><?php echo $row['dil_time']; ?></td>
                                </tr>
                                <tr>
                                    <th>Destination:</th>
                                    <td><?php echo $row['destination']; ?></td>
                                </tr>
                                <tr>
                                    <th>PickUp Point:</th>
                                    <td><?php echo $row['pickup_point']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile:</th>
                                    <td><?php echo $row['mobile']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <form action="sendmail.php?id=<?php echo $id; ?>" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><b>Available Trucks</b></span>
                                <select class="form-control" name="veh_reg">
                                   <?php while ($row1 = mysqli_fetch_assoc($res1)): ?>
                                    <option><?php echo $row1['veh_reg']; ?></option>
                                   <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><b>Available Drivers</b></span>
                                <select class="form-control" name="driverid">
                                   <?php while ($row2 = mysqli_fetch_assoc($res2)): ?>
                                    <option><?php echo $row2['driverid']; ?></option>
                                   <?php endwhile; ?>
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit" name="email">Confirm</button>
                        </form>
                    <?php else: ?>
                        <p class="text-danger">No booking found.</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
