<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
   
    if(!isset($_SESSION['assistantSession']))
    {
        // header("Location: ../index.php");
    }

    $usersession = $_SESSION['assistantSession'];
    $res = mysqli_query($con,"SELECT * FROM assistant WHERE assistantNRP=".$usersession);
    $userRow  = mysqli_fetch_array($res, MYSQLI_ASSOC);

    //ADD SCHEDULEs
    if(isset($_POST['submit'])) {
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $day = mysqli_real_escape_string($con, $_POST['day']);
        $start = mysqli_real_escape_string($con, $_POST['start']); 
        $end = mysqli_real_escape_string($con, $_POST['end']);
        $status = mysqli_real_escape_string($con, $_POST['status']);
        $nrp = mysqli_real_escape_string($con, $_POST['nrp']);

        $query = "INSERT INTO assistantschedule (assist_NRP, scheduleDate, scheduleDay, startTime, endTime,  bookAvail ) 
        VALUES ('$nrp', '$date', '$day','$start', '$end', '$status')";

        $result = mysqli_query($con, $query);

        if($result){
            ?>
            <script type="text/javascript">
                alert('Success');
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
                alert('Failed');
            </script>
            <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Welcome <?php echo $userRow['assistantFirstName'];?> <?php echo $userRow['assistantLastName'];?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    
    <body>

        <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="assets/img/logo.png" id="logo">
            </div>

            <ul class="list-unstyled components">
                <p>Halo, <?php echo $userRow['assistantFirstName'];?> <?php echo $userRow['assistantLastName'];?> </p>
                <li>
                    <a href="addschedule.php">Tambah Jadwal</a>
                </li>
                <li class="active">
                    <a href="assistantdashboard.php">Jadwal Asistensi</a>
                </li>
                <li>
                    <a href="asistenlogout.php?logout">Log Out</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <div class="container-fluid">
                <div class="panel panel-primary">
                <h2>Halo, <?php echo $userRow['assistantFirstName'];?> <?php echo $userRow['assistantLastName'];?> </h2>
                </div> 
            </div>
            </div>
        </div>  

    <script src="../praktikan/assets/js/jquery.js"></script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
    $(function() {
        $(".delete").click(function(){
            var element = $(this);
            var id = element.attr("id");
            var info = 'id=' + id;
            
            if(confirm("Are you sure you want to delete this?")){
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: info,
                    success: function(){
                    }
                });
                $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
            }
            return false;
        });

        $("#sidebar").mCustomScrollbar({
         theme: "minimal"
        });
    });
</script>

    </body>
</html>

