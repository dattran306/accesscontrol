<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
    <script src="localsearch.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link
      href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css"
      rel="stylesheet"
    />
  </head>

<?php

if(isset($_GET["type"])){
    $type = $_GET["type"];
    switch ($type) {
        case "visitor":
            $data = array("https://docs.google.com/forms/d/e/1FAIpQLScxGVFQWkRSjg2umNERG7iKUhzw-KKrMvuMCIZcwaQ6uoh8Pg/viewform?usp=sf_link","https://docs.google.com/spreadsheets/d/1fUABTFpM5xoQfk1BMUF6emiHigKsv2-uq6gyqfKky2s/edit?resourcekey#gid=512447895","VISITOR CONTROL");
          break;
        case "firelog":
          $data = array("https://docs.google.com/forms/d/e/1FAIpQLSfqmUqT_sTGhvCvmhAkwT2gNE4iVa_EUN_PZNE3Kwe17KCq5w/viewform","https://docs.google.com/spreadsheets/d/15RjrjG73LqQHjcUcOPotkEO7GmQ6QqAOGePoy5uulMY/edit?resourcekey#gid=1608665643","FIRE ALARM LOG");
            break;
        case "incidentreport":
          $data = array("https://forms.gle/A7zErDXegjof16Qo6","https://docs.google.com/spreadsheets/d/1MaF5wcb_lq88OGaDTaa8Hz_AZeYGW83-0sSGzrp3Vlo/edit?usp=sharing","INCIDENT REPORT");
          break;
        case "bqfc":
          $data = array("","./pdf/BQFC.pdf","BANQUET FORECAST");
          break;
        case "roster":
          $data = array("","https://docs.google.com/spreadsheets/d/1Ak5s0o4YEHOF_utSBsgrHUnQ2y9XiJc72Cl_DNFeYT4/edit#gid=1995283106","ROSTER");
          break;
        case "parkingticketlost":
          $data = array("https://docs.google.com/forms/d/e/1FAIpQLSeeb1GH1Kd4XrKdXeB1avuem_Yu4H8I24CKymXq9tmQItZyjA/viewform?usp=sf_link","https://docs.google.com/spreadsheets/d/1SRNukOEkhHsYfEf7Dx_N6tBEr72v4cayG3GtfApl_1w/edit?usp=sharing","GHI NHẬN MẤT THẺ XE");
          break;
        default:
        $data = array("https://forms.gle/mp19oXuhzoiVfdiDA","https://docs.google.com/spreadsheets/d/1fUABTFpM5xoQfk1BMUF6emiHigKsv2-uq6gyqfKky2s/edit?resourcekey#gid=512447895","VISITOR CONTROL");
        }

      require_once 'navbar.php';
      ?>
      <div class="mb-5"></div>
      <?php
      $output = '
      <title>'.$data[2].'</title>
      <div>
        <iframe src="'.$data[0].' " height="100%" width="30%"></iframe>
        <iframe src="'.$data[1].'" height="100%" width="65%"></iframe>
    </div>
      ';
}
else{
    $output = 'What do you want';
}

echo $output;

?>


