<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/timesheet">MAI HOUSE SECURITY</a>
    </div>
    <ul class="navbar-nav">
      <?php
        if($_SERVER['REMOTE_ADDR'] == '172.16.20.217' || $_SERVER['REMOTE_ADDR'] == '172.16.20.119' || $_SERVER['REMOTE_ADDR'] == '172.16.20.202')
        {
          ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">ADMIN</a>
        <ul class="dropdown-menu">            
            <li><a class="dropdown-item" href="/timesheet/checkstaff.php">KIÊM TRA NHÂN VIÊN</a></li>
            <li><a class="dropdown-item" href="/timesheet/addstaff.php">THÊM NHÂN VIÊN</a></li>
            <li><a class="dropdown-item" href="/handover">BÀN GIAO</a></li>
            <li><a class="dropdown-item" href="/keylist">KEY LIST</a></li>               
            <li><a class="dropdown-item" href="/timesheet/history.php">HISTORY</a></li>               
            <li><a class="dropdown-item" href="//172.16.20.202:8080">QUAN LY BAI XE</a></li>               
          </ul>
        </li>
      <?php
      }
      ?>          
      <li><a class="nav-link" href="/timesheet">Home</a></li>
      <li><a class="nav-link" href="./type.php?type=roster">Roster</a></li>           
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">REPORT</a>
      <ul class="dropdown-menu">         
        <li><a class="dropdown-item" href="./type.php?type=firelog">FIRE ALARM LOG</a></li>
        <li><a class="dropdown-item" href="./type.php?type=incidentreport">INCIDENT REPORT</a></li>   
        
        
      </ul>
    </li>
    <li><a class="nav-link" href="./type.php?type=visitor">KIỂM SOÁT SUPPLIER/VISITOR</a></li>   
    <li><a class="nav-link" href="./addnewstaff.php">THÊM NHÂN VIÊN MỚI</a></li>   
    <li><a class="nav-link" href="./type.php?type=parkingticketlost">KIỂM SOÁT MẤT THẺ XE</a></li>   
      <li><a class="nav-link" href="./type.php?type=bqfc">BANQUET FORCAST</a></li>   
      <li><a class="nav-link" href="/dothannhiet/">THÔNG KÊ</a></li>
       
    </ul>
  </div>
</nav>



