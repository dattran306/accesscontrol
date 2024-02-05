<?php
    $date ='';
    if(isset($_POST["date"])){
        $date = $_POST["date"];}
    else{
        $date = date('Y-m-d',strtotime("-1 days"));
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>THỐNG KÊ NHÂN VIÊN ĐI LÀM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
</script>
</head>
<body>
    <div class="container">
        <div class="jumbotron text-center">
            <h1>THỐNG KÊ NHÂN VIÊN ĐI LÀM</h1>
            <p>Ngày: <b><?= $date; ?></b></p>
            <form action="?" method="POST">
                <label for="selectdate">Chọn ngày:</label>
                <input type="date" id="selectdate" name="date">
                <input type="submit">
            </form>
        </div>
    <table class="table table bordered table-striped">
        <tr>
            <th>SỐ THỨ TỰ</th>
            <th>BỘ PHẬN</th>
            <th>SỐ NHÂN VIÊN ĐI LÀM</th>
        </tr>
        <tbody>
<?php

$connect = mysqli_connect("localhost", "root", "", "security");
$query = "
                SELECT
                    COUNT(timesheet.id) AS count,
                    staff_view.department_abbreviation as dept
                FROM
                    `timesheet`
                JOIN staff_view ON staff_view.id = timesheet.id_nv
                WHERE
                    LEFT(time_in, 10) LIKE '$date'
                GROUP BY
                    staff_view.department_abbreviation
            ";

$result = mysqli_query($connect, $query);

$sql_total = "
                SELECT
                    *                
                FROM
                    `timesheet`                
                WHERE
                    LEFT(time_in, 10) LIKE '$date'
                
                ";
$sql_total_result = mysqli_query($connect, $sql_total);

$total = mysqli_num_rows($sql_total_result);
$i = 1;
while($row = mysqli_fetch_array($result)){
    ?>
        
        <tr>
            <td><?= $i++; ?></td>  
            <td><?= $row["dept"]; ?></td>            
            <td><?= $row["count"]; ?></td>            
        </tr>
    
    
    <?php
}

?>
        <tr>
            <td colspan="2"><h3>TỔNG SỐ</h3></td>            
            <td><h3><?= $total ?></h3></td>            
        </tr>
</tbody>
</table>
</div>