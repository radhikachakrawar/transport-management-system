<?php
   
   $id= $_GET['id'];

   $conn=mysqli_connect('localhost','root','','transportation_ms'); 

   $sql="DELETE FROM `booking` WHERE booking_id='$id'";
    echo $sql;
   $result=mysqli_query($conn,$sql);
   if(mysqli_query($conn,$sql)){
       header("Location: bookingvlist.php");
   }else{
         echo "Not deleted";
   }
   
?>
