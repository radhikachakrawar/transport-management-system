<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $connection= mysqli_connect('localhost','root','','transportation_ms');


    $username= $_SESSION['username'];
    //echo $username;
    
    $query= "SELECT  `name`, `email` FROM `users` WHERE name='$username'";
    $result= mysqli_query($connection,$query);
    
    $row= mysqli_fetch_assoc($result);
    //$name= $row['first_name']." ". $row['last_name'];
    //echo $name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/wickedpicker.min.css">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="sweetalert2/sweetalert2.css">
    <script src="sweetalert2/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/wickedpicker.min.js"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
    <link href="index.css" rel="stylesheet" />
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
        <div class="row">
            <div class="page-header">
                <h1 style="text-align:center;">Booking</h1>
                 <?php //echo $msg; ?>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="animated bounce" action="booking-vaction.php" method="post">
                   
                    <div class="input-group">
                      <span class="input-group-addon"><b>Name</b></span>
                      <input id="name" type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>"  required>
                    </div>
                    
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon"><b>Pickup Date</b></span>
                      <input id="pic_date" type="date" class="form-control" name="pic_date" placeholder="Pickup Date" required>
                      <input type="time" name="pic_time" id="pic_time" class="form-control"/>
                      
                    </div>
                    
                    <!-- <script>
                      $( function() {
                        $( "#pic_date" ).datepicker();
                        $("#pic_time").wickedpicker();
                        
                      } );  -->
                        
                        
                        
                    </script> 
                    <br>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><b>Delivery Date</b></span>
                      <input id="dil_date" type="date" class="form-control" name="dil_date" placeholder="Delivery Date" required>
                      <input type="time" name="dil_time" id="dil_time" class="form-control"/>
                    </div>
                    
                    <!-- <script>
                      $( function() {
                        $( "#dil_date" ).datepicker();
                        $( "#dil_time" ).wickedpicker();
                      } );
                    </script> -->
                    <br>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><b>Destination</b></span>
                      <input id="destination" type="text" class="form-control" name="destination" placeholder="Destination" required>
                    </div>
                    <br>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><b>Pickup Point</b></span>
                      <input id="pickup" type="text" class="form-control" name="pickup" placeholder="pickup">
                    </div>
                    <br>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><b>Description</b></span>
                      <input id="description" type="text" class="form-control" name="description" placeholder="Any Suggestions">
                    </div>
                    <br>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><b>Email</b></span>
                      <input id="email" type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <br>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><b>Mobile</b></span>
                      <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Mobile No" required>
                    </div>
                    <br>
                    
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                    
                    <div class="input-group">
                        <input type="submit" name="submit" class="btn btn-success">
                    </div>
                     
                    
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    

    
</script>  
<footer>
        <?php include 'footer.php'; ?>
    </footer>
</div>
</body>
</html>