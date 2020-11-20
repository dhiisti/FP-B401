<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
   
    if(!isset($_SESSION['assistantSession']))
    {
        // header("Location: ../index.php");
    }

    $usersession = $_SESSION['assistantSession'];
    $res = mysqli_query($con,"SELECT * FROM asisten WHERE asistenNRP=".$usersession);
    $userRow  = mysqli_fetch_array($res, MYSQLI_ASSOC);

    //ADD SCHEDULEs
    if (isset($_POST['submit'])) {
    //variables
        // $asistenNRP =  $_POST['asistenNRP'];
        $asistenNama =  $_POST['asistenNama'];
        $asistenHP =  $_POST['asistenHP'];
        $asistenEmail =  $_POST['asistenEmail'];
        // $profilePic = ($con,$_POST['profilePic']);

        $res = mysqli_query($con, "UPDATE asisten SET asistenNama='$asistenNama', asistenHP='$asistenHP', asistenEmail='$asistenEmail' WHERE asistenNRP=". $_SESSION['assistantSession']);
        // $query = "UPDATE asisten SET asistenNRP='$asistenNRP', asistenNama='$asistenNama', asistenHP='$asistenHP', asistenEmail='$asistenEmail',  WHERE asistenNRP=".$usersession;

        // $result = mysqli_query($con, $query);

        if($res){
            ?>
            <script type="text/javascript">
                alert('Success');
            </script>
            <?php
            header( 'Location: profile.php' ) ;

        }else{
            ?>
            <script type="text/javascript">
                alert('Failed');
            </script>
            <?php
        }
        // $userRow=mysqli_fetch_array($res);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jadwal Asistensi</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="mx-auto mb-4 mt-4" href="index.php">
                <div class="sidebar-header mx-auto">
                    <img src="img/logo.png" class="img-fluid" style="width: 150px; display:block">   
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tambah Jadwal</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item  active">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Jadwal Asistensi</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?php echo $userRow['asistenNama'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Assistant Profile</h1>
                    </div>
                </div>
                        
                <div class="card-body">
                    <div class="row">
                        <!-- start -->
                        <!-- USER PROFILE ROW STARTS-->
                          
                                <div class="col-2">
                                    <div class="user-wrapper">
                                        <img class="img-profile rounded-circle mb-4" src="img/undraw_profile.svg" style="width: 100px;">
                                        <div class="description">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col user-wrapper">
                                    <div class="description">
                                        <h3> <?php echo $userRow['asistenNama']; ?></h3>
                                        <div class="panel panel-default">
                                            <div class="panel-body">    
                                                <table class="table table-user-information">
                                                    <tbody>
                                                        <tr>
                                                            <td>NRP</td>
                                                            <td><?php echo $userRow['asistenNRP']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nomor HP</td>
                                                            <td><?php echo $userRow['asistenHP']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><?php echo $userRow['asistenEmail']; ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
               
                        
                        <!-- USER PROFILE ROW END-->
                        <div class="col">
                            <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- form start -->
                                            <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                                <table class="table table-user-information">
                                                    <tbody>
                                                        <tr>
                                                            <td>NRP:</td>
                                                            <td><?php echo $userRow['asistenNRP']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama:</td>
                                                            <td><input type="text" class="form-control" id="asistenNama" name="asistenNama" value="<?php echo $userRow['asistenNama']; ?>"  /></td>
                                                        </tr>                   
                                                        <tr>
                                                            <td>Nomor HP</td>
                                                            <td><input type="text" class="form-control" id="asistenHP" name="asistenHP" value="<?php echo $userRow['asistenHP']; ?>"  /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><input type="text" class="form-control" id="asistenEmail" name="asistenEmail" value="<?php echo $userRow['asistenEmail']; ?>"  /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
                                                        </tr>
                                                    </tbody>   
                                                </table>
                                            </form>
                                                <!-- form end -->
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>