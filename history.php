<?php
      require 'navbar.php';
    ?>
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
<div class="mt-3">&nbsp;</div>
<div class="container mt-5">
<form method="POST" class="form-group">
    <input type="date" name="date" align="center">
    <input type="submit">
</form>

<table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>STT</th>
            <th>HỌ VÀ TÊN</th>
            <th>BSX</th>
            <th>BỘ PHẬN</th>
            <th>GIỜ VÀO</th>
            <th>GIỜ RA</th>            
            <th>SỐ GIỜ LAM VIỆC</th>            
            <?php
                if($_SERVER['REMOTE_ADDR'] == '172.16.20.217' || $_SERVER['REMOTE_ADDR'] == '172.16.20.119'){
            ?>
            <th>EDIT | DELETE</th>
            <?php
                }
            ?>
        </tr>
    </thead>
    <tbody>

<?php
$date = '';
$output = '';

$connect = mysqli_connect("localhost", "root", "", "security");
require_once "../dothannhiet/function.php";
logIP($connect);

if(isset($_POST["date"]))
{
    $date = $_POST["date"];
    $query = '
                SELECT
                    timesheet.id as id,
                    last_name,
                    first_name,
                    bsx,
                    department_abbreviation,
                    time_in,
                    time_out,
                    position.position_name as vitri,
                    TIMEDIFF(time_out,time_in) as sogiolamviec
                FROM
                    `timesheet`
                JOIN staff ON timesheet.id_nv = staff.id
                JOIN department ON staff.id_department = department.id
                JOIN position ON position.id = staff.id_position
                WHERE LEFT(time_in,10) LIKE "'.$date.'"
                ';
    }
else
{
    $query = '
            SELECT
                timesheet.id as id,
                last_name,
                first_name,
                bsx,
                department_abbreviation,
                time_in,
                time_out,
                position.position_name as vitri,
                TIMEDIFF(time_out,time_in) as sogiolamviec 
            FROM
                `timesheet`
            JOIN staff ON timesheet.id_nv = staff.id
            JOIN department ON staff.id_department = department.id
            JOIN position ON position.id = staff.id_position
            ORDER BY time_in DESC
            LIMIT 200
            ';
}

$result = mysqli_query($connect,$query);
$i = 1;
while($row = mysqli_fetch_array($result))
{
    ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row["last_name"].' '.$row["first_name"]?></td>
                    <td><?= $row["vitri"] ?></td>
                    <td><?= $row["department_abbreviation"]?></td>
                    <td><?= $row["time_in"]?></td>
                    <td><?= $row["time_out"]?></td>
                    <td><?= $row["sogiolamviec"]?></td>            
                    <?php
                if($_SERVER['REMOTE_ADDR'] == '172.16.20.217' || $_SERVER['REMOTE_ADDR'] == '172.16.20.119'){
            ?>        
                    <td><button id="delete" data-id1="<?= $row["id"]?>" class="btn btn-danger">Delete</button></td>
                    <?php
                }
            ?>
                </tr>
    <?php
}

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