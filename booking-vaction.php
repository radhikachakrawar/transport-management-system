<?php
    $connection= mysqli_connect('localhost','root','','transportation_ms');
    session_start();

    $msg="";
    
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $pic_date=$_POST['pic_date'];
        $pic_time=$_POST['pic_time'];
        $dil_date=$_POST['dil_date'];
        $dil_time=$_POST['dil_time'];
        $destination=$_POST['destination'];
        $pickup=$_POST['pickup'];
        $description=$_POST['description'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $username= $_POST['username'];
        
        $insert_query="INSERT INTO `booking`(`booking_id`, `name`,`username` , `pic_date`, `pic_time`, `dil_date`, `dil_time`, `destination`, `pickup_point`, `description`, `email`, `mobile`, `confirmation`, `veh_reg`, `driverid`, `finished`) VALUES ('','$name','$username','$pic_date','$pic_time','$dil_date','$dil_time','$destination','$pickup','$description','$email','$mobile','','','','')"; 
        echo $name;
        
        
        
        
        $res= mysqli_query($connection,$insert_query);
        
         if($res==true){
            $msg= "<script language='javascript'>
                                       swal(
                                            'Success!',
                                            'Registration Completed!',
                                            'success'
                                            );
				          </script>";
            
        }
        else{
            die('unsuccessful' .mysqli_error($connection));
        }
        
        
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
     <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css"> 
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
</head>
<body>
    <?php echo $msg;
    ?>
    
    <script>
    
        var timer = setTimeout(function() {
            window.location='bookingv.php'
        }, 1000);
    </script>

</body>
</html>
