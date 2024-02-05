<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Add Staff</title>
</head>
<body>
    <?php
    require_once './navbar.php';
    if(isset($_POST['submit'])){
        $last_name = $_POST["last_name"];
        $first_name = $_POST["first_name"];
        $bsx = $_POST["bsx"];
        $department = $_POST["department"];
        $id_position = $_POST["id_position"];
        $connect = mysqli_connect("localhost", "root", "", "security");
        $query = 'INSERT INTO `staff`(last_name,first_name,bsx,id_department,id_position) VALUES("'.$last_name.'","'.$first_name.'","'.$bsx.'","'.$department.'","'.$id_position.'")';        
        if(mysqli_query($connect,$query)){
            echo '<div class="alert alert-success">Added successfully</div>';
        }
        mysqli_close($connect);
    }
    ?>
    <form action="?" method='POST' autocomplete="off">
    <div class="mt-3">&nbsp;</div>    
    <div class="container mt-5">
        <div class="row">
            <div class="col-4 mb-3">
              <label for="last_name" class="form-label">Họ</label>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Họ">
            </div>
            <div class="col-4 mb-3">
                <label for="first_name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Tên">
              </div>
            <div class="col-4 mb-3">
                <label for="bsx" class="form-label">BSX (Ghi 4-5 số cuối)</label>
                <input type="text" class="form-control" id="bsx" name="bsx" placeholder="BSX">
            </div>
        </div>
        <div class="row">
        <div class="col-6 mb-3">
                <label for="department" class="form-label">Bộ phận</label>
                    <select class="form-control" id="department" name="department">
                        <?php
                            $connect = mysqli_connect("localhost", "root", "", "security");
                            $query = 'SELECT * FROM `department`';
                            $result = mysqli_query($connect,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$row["id"].'">'.$row["department_name"].'</option>';
                            }
                            mysqli_close($connect);                
                        ?>                
                    </select>
            </div>
            <div class="col-6 mb-3">
                <label for="position" class="form-label">Câp bậc</label>
                    <select class="form-control" id="position" name="id_position">
                        <?php
                            $connect = mysqli_connect("localhost", "root", "", "security");
                            $query = 'SELECT * FROM `position`';
                            $result = mysqli_query($connect,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$row["id"].'">'.$row["position_name"].'</option>';
                            }
                            mysqli_close($connect);                
                        ?>                
                    </select>
                </div>
            </div>
            <div class="mb-3">      
              <button type="submit" name="submit" class="btn btn-success">Thêm vào</button>
            </div>
        </div>
    </form>
</body>
</html>



