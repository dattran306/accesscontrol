<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "security");

$output = '';


if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM staff_view
  WHERE id LIKE '%".$search."%' AND status = 'active'
  OR first_name LIKE '%".$search."%' AND status = 'active'
  OR bsx LIKE '%".$search."%' AND status = 'active'
  OR department_abbreviation LIKE '%".$search."%'  AND status = 'active'
  
 ";
}
else
{
 $query = "
  SELECT * FROM staff_view WHERE status = 'active' ORDER BY id_position ASC, id_department ASC
  
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <h1 class="text-center text-success"><strong>'.mysqli_num_rows($result).'</strong> nhân viên chưa vào</h1> 
  <div class="table-responsive">
   <table class="table table bordered table-striped">
    <tr>
     <th>HÌNH ẢNH</th>
     <th>MSNV</th>
     <th>HỌ</th>
     <th>TÊN</th>
     <th>CHỨC VỤ</th>
     <th>BỘ PHẬN</th>     
     <th>LAST MONTH WORKDAYS</th>     
     <th>BIỂN SỐ XE</th>     
     <th>CHECK-IN</th>          
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
   $sql = 'SELECT count(*) as lastmonthworkdays FROM `timesheet` WHERE `id_nv`= '.$row["id"].' AND month(`time_in`) = MONTH(CURRENT_DATE())-1';
   $rs = mysqli_query($connect, $sql);
   $rowwkd = mysqli_fetch_array($rs);
   
  $output .= '
   <tr>
    <td><img src="img/'.$row["id"].'.jpg" width="100px"></td>
    <td><h2 class="alert alert-info">'.$row["id"].'</h2></td>
    <td>'.$row["last_name"].'</td>
    <td>'.$row["first_name"].'</td>
    <td>'.$row["position_abbreviation"].'</td>
    <td>'.$row["department_abbreviation"].'</td>    
    <td>'.$rowwkd["lastmonthworkdays"].'</td>    
    <td><h2 class="alert alert-success">'.$row["bsx"].'</h2></td>    
    
    <td><button data-id2="'.$row["id"].'" class="btn btn-success" id="check-in">Check-in</button></td>    
    
   </tr>
  ';
 }
  


 echo $output;
}



?>
