<?php
//fetch.php
   $connect = mysqli_connect("localhost", "root", "", "security");
   $record_per_page = 15;
   $output = '';
   if(isset($_POST["truyvan"]))
   {
      $search = mysqli_real_escape_string($connect, $_POST["truyvan"]);
      $sql = "
      SELECT * FROM `timesheet_view`
      WHERE staff_id LIKE '%".$search."%'
      OR first_name LIKE '%".$search."%'
      OR bsx LIKE '%".$search."%'
      OR department_abbreviation LIKE '%".$search."%' 
      
      ";
   }
   else
   {
      $sql = "
		SELECT * FROM `timesheet_view` ORDER BY `id_position` ASC
      ";
   }
   $result = mysqli_query($connect, $sql);

   if(mysqli_num_rows($result) > 0)
   {
      $output .= '
         <h1 class="text-center text-danger"><strong>'.mysqli_num_rows($result).'</strong> nhân viên trong khách sạn</h1>
         <div class="table-responsive">
            <table class="table table bordered table-striped">
               <tr>     
                  <th>Hình ảnh</th>
                  <th>MSNV</th>
                  <th>HỌ</th>
                  <th>TÊN</th>
                  <th>BỘ PHẬN</th>     
                  <th>LMDW</th>     
                  <th>GIỜ VÀO</th>     
                  <th>BIỂN SỐ XE</th>     
                  <th>CHECK-OUT</th>          
               </tr>
      ';
      while($row = mysqli_fetch_array($result))
      {
         $sql = 'SELECT count(*) as lastmonthworkdays FROM `timesheet` WHERE `id_nv`= '.$row["staff_id"].' AND month(`time_in`) = MONTH(CURRENT_DATE())-1';
   $rs = mysqli_query($connect, $sql);
   $rowwkd = mysqli_fetch_array($rs);
   
      $output .= '
               <tr>         
                  <td><img src="img/'.$row["staff_id"].'.jpg" width="100px"></td>
                  <td><h2 class="alert alert-info">'.$row["staff_id"].'</h2></td>
                  <td>'.$row["last_name"].'</td>
                  <td>'.$row["first_name"].'</td>    
                  <td>'.$row["department_abbreviation"].'</td>    
                  <td>'.$rowwkd["lastmonthworkdays"].'</td>    
                  <td>'.$row["time_in"].'</td>    
                  <td><h2 class="alert alert-success">'.$row["bsx"].'</h2></td>    

                  <td><button data-id1="'.$row["id"].'" id="btn_check_out" class="btn btn-danger">Check-out</button></td>
               </tr>
      ';
      }
 
   echo $output;
   }



?>
