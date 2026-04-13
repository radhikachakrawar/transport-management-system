<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'transportation_ms');
$msg = "";

if (isset($_POST['submit'])) {

    $drname = $_POST['drname'];
    $drjoin = $_POST['drjoin'];
    $drmobile = $_POST['drmobile'];
    $drlicense = $_POST['drlicense'];
    $drlicensevalid = $_POST['drlicensevalid'];
    $draddress = $_POST['draddress'];
    $drphoto = $_FILES['file']['name'];

    // Upload image
    move_uploaded_file($_FILES['file']['tmp_name'], "picture/" . $drphoto);

    $insert_query = "
        INSERT INTO driver
        (drname, drjoin, drmobile, drlicense, drlicensevalid, draddress, drphoto, dr_available)
        VALUES
        ('$drname', '$drjoin', '$drmobile', '$drlicense', '$drlicensevalid', '$draddress', '$drphoto', 'Yes')
    ";

    $res = mysqli_query($connection, $insert_query);

    if ($res) {
        $_SESSION['msg'] = "<script>
            swal('Success!', 'Driver Added Successfully!', 'success');
        </script>";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        die("Error: " . mysqli_error($connection));
    }
}
?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Bootstrap Simple Admin Template</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group-addon {
            width: 150px;
            text-align: left;
            font-weight: bold;
            background-color: #f5f5f5;
        }

        .form-control {
            height: 40px;
            box-shadow: none;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea.form-control {
            resize: vertical;
        }

        .btn-success {
            width: 100%;
            height: 40px;
            background-color: #5cb85c;
            border-color: #4cae4c;
            font-size: 16px;
            font-weight: bold;
        }

        .page-header {
            text-align: center;
        }

        input[type="file"].form-control {
            padding: 3px;
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
            <!-- end of navbar navigation -->            <div class="container">
                <div class="row">

                    <div class="page-header">
                        <h1 style="text-align: center;">New Driver Form</h1>
                        <?php echo $msg; ?>



                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-6 animated bounceIn">



                        <br>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                            <div class="input-group">
                                <span class="input-group-addon"><b>Driver Name</b></span>
                                <input id="drname" type="text" class="form-control" name="drname" placeholder="Name">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><b>Mobile</b></span>
                                <input id="drmobile" type="text" class="form-control" name="drmobile"
                                    placeholder="Mobile No">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><b>Driver Joining Date</b></span>
                                <input id="drjoin" type="date" class="form-control" name="drjoin"
                                    placeholder="Joining date">
                            </div>
                            <br>



                            <!-- <script>
                                $(function () {
                                    $("#drjoin").datepicker();
                                });
                            </script> -->

                            <div class="input-group">
                                <span class="input-group-addon"><b>ID</b></span>
                                <input id="drid" type="text" class="form-control" name="drid" placeholder="id No">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><b>License No</b></span>
                                <input id="drlicense" type="text" class="form-control" name="drlicense"
                                    placeholder="License No">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><b>License End Date</b></span>
                                <input id="drlicensevalid" type="text" class="form-control" name="drlicensevalid"
                                    placeholder="Validity date">
                            </div>
                            <br>



                            <script>
                                $(function () {
                                    $("#drlicensevalid").datepicker();
                                });
                            </script>


                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><b>Driver Address</b></span>
                                <textarea rows="5" id="draddress" type="text" class="form-control" name="draddress"
                                    placeholder="Address"> </textarea>

                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><b>Photo</b></span>
                                <input type="file" class="form-control" name="file">

                            </div>


                            <br>

                            <div class="input-group">
                                <input type="submit" name="submit" class="btn btn-success">

                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>

                </div>


            </div>
            <script src="assets/vendor/jquery/jquery.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/chartsjs/Chart.min.js"></script>
            <script src="assets/js/dashboard-charts.js"></script>
            <script src="assets/js/script.js"></script>
        </div>
    </div>
</body>

</html>