<?php
session_start();

if(isset($_SESSION['name'] )){

    include 'includes/sidbar_l.php';
    //include 'includes/nav.php';
    include 'connection.php';

if (isset($_POST['submit'])) {
    $nicpost = $_POST['search-box'];
    $nicpost_2 = $_POST['search-box_2'];
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];
    $tlecture = $_POST['tlecture'];


    $query = mysqli_query($con, "insert into  t_time (le_name,co_name,s_time,e_time,to_time,approval) value('$nicpost','$nicpost_2','$stime',' $etime','$tlecture','Not Approved')");
    if ($query) {


        //echo "<script>alert popup()('Data Successfully Added.');</script>";
        echo "<script>sucess</script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    }
}
}else{
    header ("Location: login.php");
    exit();
}

 $name = $_SESSION['name'];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .frmSearch {
            border: 1px solid #eaedeb;
            background-color: #fdfefe;
            margin: 2px 0px;
            padding: 40px;
            border-radius: 12px;
        }

        #country-list {
            float: left;
            list-style: none;
            margin-top: 5px;
            margin-left: 0%;
            padding: 0;
            width: 190px;
            position: absolute;
            border-radius: 12px;
        }

        #country-list li {
            padding: 10px;
            background: #f0f0f0;
            border-bottom: #bbb9b9 1px solid;
        }

        #country-list li:hover {
            background: #ece3d2;
            cursor: pointer;
        }

        #search-box {
            padding: 10px;
            border: #eaedeb 1px solid;
            border-radius: 12px;
        }
        #tlecture {
            padding: 10px;
            border: #eaedeb 1px solid;
            border-radius: 12px;
        }


        #search-box_2 {
            padding: 10px;
            border: #eaedeb 1px solid;
            border-radius: 12px;
        }

        #status {
            padding: 10px;
            border: #eaedeb 1px solid;
            border-radius: 12px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- <script src="../pay/js/jquery-2.1.4.js" type="text/javascript"></script> -->
    <!-- Page level plugin JavaScript-->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $("#search-box_2").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "search/le_check.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function() {
                        $("#search-box_2").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function(data) {
                        $("#suggesstion-box_2").show();
                        $("#suggesstion-box_2").html(data);
                        $("#search-box_2").css("background", "#FFF");
                    }
                });
            });
        });

        function selectCountry_2(val) {
            $("#search-box_2").val(val);
            $("#suggesstion-box_2").hide();
        }

    </script>

    <script>
   function date(){
            p = "1/1/1970 ";
            var starth = document.getElementById("stime").value;
            var endh= document.getElementById("etime").value;
           var difference = new Date(new Date(p+endh) - new Date(p+starth)).toUTCString().split(" ")[4];
            document.getElementById("tlecture").value =  difference;


        }
</script>



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper " style="padding-left: 20%;">
        <!-- <div class="row" style="padding-left: 30%;"> -->


        <div class="frmSearch">

            <form class="form-inline" method="post">
          
                <div class="form-group">
                    <label for="name">Lecture Name:  &nbsp</label> <br>
                    <br> <input type="text" id="search-box" name="search-box"  size="60" value="<?php echo $name?>" readonly  />
                    <div id="suggesstion-box" align="center" ></div>

                </div>
                <br><br>
                <div class="form-group">
                    <label for="cname">Course Name: &nbsp </label></br>
                    <br> <input type="text" id="search-box_2"  name="search-box_2" required placeholder="Search By Name..." size="60"  />
                    <div id="suggesstion-box_2" align="center"></div>

                </div>
                <br>
                <div class="form-group">
                   &nbsp
                    <label for="stime">Start Time:  &nbsp </label></br>
                    <br> <input type="time" id="stime" name="stime"  size="60"  required="true" />
                    &nbsp
                    <label for="etime">End Time: &nbsp </label></br>
                    <br>
                    <br> <input type="time" id="etime" name="etime"  size="60"  required="true" />
            

                </div>
                
               <div class="form-group">
                    <label for="cname">Total Lecture : &nbsp</label></br>
                  <br>
                    <input type="text" id="tlecture"  name="tlecture"  size="60" onclick="date()" />
               
                    <!-- <button  class="btn btn-primary" > Calculate</button> -->

                </div>  
            
                <button type="submit" class="btn btn-primary" name="submit" style=" position: absolute; bottom: 60%;"  onClick="date()"> Submit </button>





            </form>
            <br>
        </div>
        <br>
        <div class="row col-md-12 ">
            <table class="table table-striped table-bordered" id="dataTable" width="96%"   cellspacing="0">
            <thead>
                <tr>

                    
                    <th>Course Name</th>
                     <th>Start Time</th>
                    <th>End Time</th>
                    <th>Total Hours</th>
                    <th>Approval</th>
                   


                </tr>
            </thead>
            <?php
            $ret = mysqli_query($con, "select * from  t_time where le_name='$name'");

            while ($row = mysqli_fetch_array($ret)) {
            ?>

                <tbody>
                    <tr>
                       
                        <td><?php echo $row['co_name']; ?></td>
                        <td><?php echo $row['s_time']; ?></td>
                        <td><?php echo $row['e_time']; ?></td>
                        <td><?php echo $row['to_time']; ?></td>
                        <td><?php echo $row['approval']; ?></td>
                        
                        </td>
                    </tr>

                </tbody>
            <?php

            } ?>
        </table>
    </div>
      

       


                                    </div>
                                  

                                    </div>

            <?php include 'includes/footer.php'; ?>





    

    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>

  


  


</body>

</html>