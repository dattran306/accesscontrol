
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready( function () {
    $('#table_id').DataTable(
        
    );
} );
</script>
<div class="container">
<table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>STT</th>
            <th>HỌ VÀ TÊN</th>            
            <th>BỘ PHẬN</th>
            <th>GIỜ VÀO</th>
            <th>GIỜ RA</th>            
            
        </tr>
    </thead>
    <tbody>

<?php
$output = '';
$connect = mysqli_connect("localhost", "root", "", "security");

$dept = $_GET["dept"];

    $query =    "
            SELECT
                staff.id as id,
                staff.last_name as last_name,
                staff.first_name as first_name,
                department.department_abbreviation as dept_abbr,
                timesheet.time_in as time_in,
                timesheet.time_out as time_out
            FROM
                `timesheet`
            JOIN staff ON staff.id = timesheet.id_nv
            JOIN department ON department.id = staff.id_department
            WHERE
                LEFT(timesheet.time_in, 7) = '2021-10' AND department.department_abbreviation = '".$dept."'            
            ";

$result = mysqli_query($connect,$query);
$i = 1;
while($row = mysqli_fetch_array($result))
{
    $output .='
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row["last_name"].' '.$row["first_name"].'</td>                    
                    <td>'.$row["dept_abbr"].'</td>
                    <td>'.$row["time_in"].'</td>
                    <td>'.$row["time_out"].'</td>                    
                </tr>
    ';
}
echo $output;
?>
</tbody>
</table>
</div>

<script>
    $(document).ready(function(){
        $(document).on("click", "#delete", function(){
            var id = $(this).data("id1");
            if(confirm("Are you sure to delete?")){
                $.ajax({
                    url:"delete.php",
                    method:"post",
                    data:{id:id},                    
                    success:function(data){
                        alert(data);
                    }
                })
            }else{
                return false;
            }
        });
    });
</script>