<?php


$connect = mysqli_connect("localhost", "root", "", "security");
$sql = "SELECT * FROM `timesheet_view` ORDER BY id_position	ASC,  time_in ASC";
$result = mysqli_query($connect,$sql);
if(mysqli_num_rows($result) > 0){
    echo 'dât';

}

