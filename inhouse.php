<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
    <link
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css"
      rel="stylesheet"
    />

<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "security");
$output = '';

 $query = "SELECT * FROM `timesheet_view`";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>BỘ PHẬN</th>   
            <th>MSNV</th>
            <th>HỌ</th>
            <th>TÊN</th>                                
            <th>GIỜ VÀO</th>                                
            <th>CHECKOUT</th>       
            </tr>
         </thead>
        <tbody>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["department_abbreviation"].'</td>   
    <td>'.$row["staff_id"].'</td>
    <td>'.$row["last_name"].'</td>
    <td>'.$row["first_name"].'</td>          
    <td>'.$row["time_in"].'</td>          
    <td><button data-id1="'.$row["id"].'" id="btn_check_out" class="btn btn-danger">Check out</button></td>    
   </tr>
  ';
 }
 

}
 else{
    $output .= '</tbody></table>';
 }
 echo $output;

?>

<script>
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
