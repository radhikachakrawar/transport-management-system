<?php
    $connection= mysqli_connect('localhost','root','','transportation_ms');
    session_start();

    $id= $_GET['id'];

    $sql= "UPDATE `tripcost` SET `paid`='1' WHERE booking_id='$id'";
    $result= mysqli_query($connection,$sql);

    if($result){
        header ('Location: bookingvlist.php');
    }
?>