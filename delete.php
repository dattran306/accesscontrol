<?php
$connect = mysqli_connect("localhost", "root", "", "security");
if(isset($_POST["id"])){
    $query = "DELETE FROM timesheet WHERE id = '".$_POST["id"]."'";
    if(mysqli_query($connect,$query)){
        echo "Data deleted successful";
    }
}
?>