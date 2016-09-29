<?php
session_start();
require 'config.php';

        $level = $_SESSION['level'];
        $id = $_SESSION['sess_id'];
        $name = $_SESSION['name'];
        $function = $_SESSION['function'];   

        //$region_name = $_POST['region_name']; 
$con=mysqli_connect("localhost","bootstrap","bootstrap","vfrms");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT * FROM records";

$records=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vodafone Records Management System</title>

    <!-- Bootstrap Core CSS -->
    <link rel="icon" type="icon" href="favicon.ico">
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="./dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="./bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.html">Records Management</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">            
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class=""  >
                       <i class="fa fa-user fa-fw"></i> <?php echo $name; ?>
                    </a>
                </li>
                <li class="dropdown">
                    <a class=""  href="index.html">
                       <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>
                   <!--  <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul> -->
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Records<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="addFile.php">Add File</a>
                                </li>
                                <li>
                                    <a href="dashboard.php">View File</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        
                           
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
         <div class="col-lg-8">
                                   
                                </div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          
<!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-file-o fa-fw"></i> Stored Records
                            <div class="pull-right">
                                <a class="btn btn-info btn-xs" href="addFile.php">Add New File</a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
    <thead>
    
    <tr>
   <th>File Name</th>
    <th>File Type</th>
    <th>File Size(KB)</th>
    <th>Date Created</th>
    <th>Owner</th>
    </tr>
        </thead>
        
<tbody>       
    <?php
    if ($level == 'Director') {
        $result = mysqli_query($con,"SELECT * FROM records ");
    }elseif ($level == 'Manager') {
        $result = mysqli_query($con,"SELECT * FROM records WHERE decider = 'Manager' ");    
    }

    
    $count = mysqli_num_rows($result);

// echo "<h3><center>Today's Reservations</center></h3><br><br>";

while($row=mysqli_fetch_array($result)){
    // $reservation_id = $row['reservation_id'];
    if ($row['fileType'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
        $newfileType = 'Docx';
    }elseif ($row['fileType'] == 'application/pdf') {
        $newfileType = 'Pdf';
    }elseif ($row['fileType'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        $newfileType = 'Xlsx';
    }
    ?>
    
    <tr>
    
        
            <td><a href="uploads/<?php echo $row['file']; ?>" target="_blank"><?php echo $row['fileName'];?></a></td>
            <td><?php echo $newfileType;?></td>
            <td><?php echo $row['size'];?></td>
            <td><?php echo $row['dateCreated'];?></td>
            <td><?php echo $row['owner'];?></td>       
            
    </tr>
    
    <?php   } //end of while loop ?>
        
    </tbody>
</table> 
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
    <!-- jQuery -->
    <script src="./bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./bower_components/raphael/raphael-min.js"></script>
    <script src="./bower_components/morrisjs/morris.min.js"></script>
    <script src="./js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

</body>

</html>
