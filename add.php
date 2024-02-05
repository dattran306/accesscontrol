<?php
$code_id = $_POST["code_id"];
$connect = mysqli_connect("localhost", "root", "", "security");
$query="SELECT * FROM timesheet WHERE id_nv='$code_id' AND time_out IS NULL";
$result = mysqli_query($connect,$query);
if(mysqli_num_rows($result)>0){
    echo 'Duplicate';
}else{
    $sql = "INSERT INTO `timesheet` (`id_nv`) VALUES ('$code_id')";
    if(mysqli_query($connect,$sql)){
        echo 'Checked in';
}
}

$connect->close();
?>
