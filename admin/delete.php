<?php
//delete.php
$connect = mysqli_connect("localhost", "root", "", "security");
if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  $query = "UPDATE staff SET status='deactive' WHERE id = '".$id."'";
  mysqli_query($connect, $query);
 }
}
?>
