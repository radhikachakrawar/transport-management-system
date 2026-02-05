<?php
   
   $id= $_GET['id'];

   $conn=mysqli_connect('localhost:3307','root','','transportation_ms');
   $sql="DELETE FROM bill WHERE bill_id='$id'";
   $result=mysqli_query($conn,$sql);
   if(mysqli_query($conn,$sql)){
       header("Location: bill.php");
   }else{
         echo "Not deleted";
   }
   
?>
