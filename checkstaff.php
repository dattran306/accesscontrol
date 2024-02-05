<?php
      require 'navbar.php';
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
<div class="container mt-5">&nbsp;</div>
<div class="container mt-5">
<form method="POST" class="form-group" autocomplete="off">
    <input type="text" name="id_nv">
    <select name="month">
        <?php
            $output = '';            
            for($i = 1;$i<=12;$i++){
                if(strlen($i) < 2){
                    echo '<option value="0'.$i.'">0'.$i.'</option>';    
                }else{
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }                
            }
        ?>        
    </select>
    <select name="year">
        <?php
            $output = '';
            for($i = date('Y');$i>=2021;$i--){
                    echo '<option value="'.$i.'">'.$i.'</option>';
            }
            
        ?>        
    </select>
    <input type="submit" class='btn btn-success'>
</form>
<table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>STT</th>                                    
            <th>GIỜ VÀO</th>
            <th>GIỜ RA</th>            
            <th>Total time</th>
        </tr>
    </thead>
    <tbody>


<?php
$date = '';
$output = '';
$query='';
$connect = mysqli_connect("localhost", "root", "", "security");
if(isset($_POST["year"]))
?>

        <?php
{
    $year = $_POST["year"];
    $month = $_POST["month"];
    $id_nv = $_POST["id_nv"];
    $query = '
                SELECT
                *, TIMEDIFF(time_out,time_in) as sogiolamviec 
                FROM
                    `timesheet`                
                WHERE id_nv = "'.$id_nv.'" AND left(time_in,7) = "'.$year.'-'.$month.'"
                ';
                $result = mysqli_query($connect,$query);
    $i = 1;
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result))
        {
            $output .='
                        <tr>
                            <td>'.$i++.'</td>
                            <td>'.$row["time_in"].'</td>
                            <td>'.$row["time_out"].'</td>
                            <td>'.$row["sogiolamviec"].'</td>
                        </tr>
            ';
        }
        echo $output;
    }
    
    
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