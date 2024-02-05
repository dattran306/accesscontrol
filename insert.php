<?php

$connect = mysqli_connect("localhost", "root", "", "security");

$id_nv = $_GET['id_nv'];
$query="SELECT * FROM timesheet WHERE id_nv='$id_nv' AND time_out IS NULL";
$result = mysqli_query($connect,$query);

if(mysqli_num_rows($result)>0){
    header("Location:index.html");
}else{
$sql = "INSERT INTO `timesheet` (`id_nv`) VALUES ('$id_nv')";
if ($connect->query($sql) === TRUE) {
  header("Location:index.html");
} else {
  echo "Error: " . $sql . "<br>" . $connect->error;
}
}

$connect->close();
?>
