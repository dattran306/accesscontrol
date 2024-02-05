<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>TIME SHEET</title>
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
  <body>
    <?php
      require 'navbar.php';
      $connect = mysqli_connect("localhost", "root", "", "security");
      require_once "../dothannhiet/function.php";
      logIP($connect);
    ?>
    <div class="fluid-container mt-5">
      <div class="row" id="roster">          
        <div class="col-sm-6">
        <div class="alert alert-success">
          <h1>Check-in</h1>          
        </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Search</span>
                <input type="text" name="search_text" id="search_text" placeholder="Tìm kiếm" class="form-control"/>
              </div>
              <div id="result"></div>
              <div id="result_more"></div>
              <div id="result_more_2"></div>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="alert alert-danger">
          <h1>Check-out</h1>          
        </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Search</span>
                <input type="text" name="tim_kiem" id="tim_kiem" placeholder="Tìm kiếm" class="form-control"/>
              </div>
              <div id="result_2"></div>
            </div>
        </div>        
      </div>
    </div>

  </body>
</html>

<script>
  $(document).ready(function () {
    load_data();
    load_inhouse();

    var limit = 15;
    var start = 0;
    var action = 'inactive';
    function load_checkin_data(limit,start){
      $.ajax({
        url:'fetch.php',
        method:'POST',
        data:{limit:limit,start:start},
        cache:false,
        success:function(data){
          $('result_more').append(data);
          if(data == ''){            
            action = 'active';
          }else{
            action = 'inactive';
          }
        }
      });
    }


    if(action == 'inactive'){
      action = 'active';
      load_checkin_data(limit,start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#result_more").height() && action == 'inactive'){
        action = 'active';
        start = start + limit;
        setTimeout(() => {
          load_checkin_data(limit,start);
        }, 1000);
      }
    });


    function load_data(query) {
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: { query: query },
        success: function (data) {
          $("#result").html(data);
        },
      });
    }

    function load_inhouse(truyvan) {
      $.ajax({
        url: "fetch_out.php",
        method: "POST",
        data: { truyvan: truyvan },
        success: function (data) {
          $("#result_2").html(data);
        },
      });
    }

    $(document).on('click','#check-in',function(){
      var code_id = $(this).data('id2');
      $.ajax({
        url:'add.php',
        method:'POST',
        data:{code_id:code_id},
        dataType:'text',
        success:function(data){          
          load_inhouse();
          load_data();
        }
      })
    });

    $(document).on('click','#btn_check_out',function(){
      var id = $(this).data('id1');
      $.ajax({
        url:'out.php',
        method:'POST',
        data:{id:id},
        dataType:'text',
        success:function(data){          
          load_inhouse();
          load_data();
        }
      })
    });

    setInterval(() => {
          load_inhouse();
          load_data();
    }, 50000);

    $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      }); 

      $(document).on('click', '.pagination_out', function(){  
           var page = $(this).attr("id");  
           load_inhouse(page);  
      }); 
    
    $("#search_text").keyup(function () {
      var search = $(this).val();
      if (search != "") {
        load_data(search);
      } else {
        load_data();
      }

    });
    
    $("#tim_kiem").keyup(function () {
      var search = $(this).val();
      if (search != "") {
        load_inhouse(search);
      } else {
        load_inhouse();
      }

    });



  });


</script>


