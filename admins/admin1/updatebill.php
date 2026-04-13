<?php
   $id=$_POST['bill_id'];
   $salary=$_POST['total_km'];
   $equipment=$_POST['extra_cost'];
   $oil=$_POST['fuel_cost'];
   $tcost=$_POST['total_cost'];

   $conn=mysqli_connect('localhost','root','','transportation_ms');
   $sql="UPDATE bill SET id='$id',total_km='$fare',extra_cost='$other',fuel_cost='$fuel',total_cost='$tcost' WHERE id='$id'";

   if(mysqli_query($conn,$sql)){
      header("Location: showbill.php?id=".$id); 
   }else{
        echo "Not inserted";
   }
?>