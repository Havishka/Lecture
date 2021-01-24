<?php

include 'includes/a_sidbar.php';
include 'includes/a_nav.php';
include 'connection.php';






    if(isset($_GET['editid'])){
        $cid = $_GET['editid'];
    // $approved = 'approved';
    // $query ="UPDATE t_time SET approval = 'Approved' Where id='$cid' ";
    // mysqli_query($con,$query);

    $sqlBidAccept = "SELECT *FROM t_time WHERE id = '$cid' "; //for accept bid
    $BidAccept = mysqli_query($con, $sqlBidAccept);
    $BidAcceptResultCheck = mysqli_num_rows($BidAccept);
    $bidAcceptRow = mysqli_fetch_assoc($BidAccept);

    if($BidAcceptResultCheck > 0) {
        
        $Accepted = 1;
        
        //$AcceptedPrice = $bidAcceptRow['bid'];
        $accepted = 'Approved';
     
        $query ="UPDATE t_time SET g_approval = '$accepted' Where id='$cid'";
        mysqli_query($con,$query);
        

    }else {

        $Accepted = 0;
    }
    }



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

        #search-box_2 {
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

    <script src="../pay/js/jquery-2.1.4.js" type="text/javascript"></script>
    <!-- Page level plugin JavaScript-->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search-box").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "search/search.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function() {
                        $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function(data) {
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#search-box").css("background", "#FFF");
                    }
                });
            });
        });

        function selectCountry(val) {
            $("#search-box").val(val);
            $("#suggesstion-box").hide();
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#search-box_2").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "search/c_search.php",
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



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper " style="padding-left: 20%;">
        <!-- <div class="row" style="padding-left: 30%;"> -->


        
    <br><br>
   


        <table class="table table-striped table-bordered" id="dataTable" width="96%" cellspacing="0">
            <thead>
                <tr>

                    <th>Lecture Name</th>
                    <th>Course Name</th>
                     <th>Start Time</th>
                    <th>End Time</th>
                    <th>Total Hours</th>
                    <th>Approval</th>
                    <th>Center Manager Approval</th>
                    <th>Action</th>


                </tr>
            </thead>
            <?php
            $ret = mysqli_query($con, "select * from  t_time");

            while ($row = mysqli_fetch_array($ret)) {
            ?>

                <tbody>
                    <tr>
                        <td><?php echo $row['le_name']; ?></td>
                        <td><?php echo $row['co_name']; ?></td>
                        <td><?php echo $row['s_time']; ?></td>
                        <td><?php echo $row['e_time']; ?></td>
                        <td><?php echo $row['to_time']; ?></td>
                        <td><?php echo $row['g_approval']; ?></td>
                        <td><?php echo $row['approval']; ?></td>
                        <td><a href="a_approve.php?editid=<?php echo $row['id']; ?> Approved" class="btn btn-xs btn-primary">Approve<i class="feather icon-clock m-t-10 f-16 "></i></a>
                        </td>
                    </tr>

                </tbody>
            <?php

            } ?>
        </table>
    </div>












    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

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




    <?php include 'includes/footer.php'; ?>

</body>

</html>