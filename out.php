<?php

$connect = mysqli_connect("localhost", "root", "", "security");

$query = "UPDATE timesheet SET time_out = CURRENT_TIMESTAMP WHERE id = '".$_POST["id"]."'";


if(mysqli_query($connect,$query)){
    echo 'Check-out';
}

$connect->close();
?>
