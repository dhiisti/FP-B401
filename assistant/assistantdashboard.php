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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    
    <body>

    <div class="wrapper ">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="assets/img/logo.png" id="logo">
            </div>

            <ul class="list-unstyled components">
                <p>Halo, <?php echo $userRow['assistantFirstName'];?> <?php echo $userRow['assistantLastName'];?> </p>
                <li>
                    <a href="addschedule.php"><i class="far fa-calendar-plus mr-md-4" ></i>Tambah Jadwal</a>
                </li>
                <li  class="active">
                    <a href="assistantdashboard.php"><i class="far fa-calendar-alt mr-md-4"></i>Jadwal Asistensi</a>
                </li>
                <li>
                    <a href="asistenlogout.php?logout"><i class="fas fa-power-off mr-md-4"></i>Log Out</a>
                </li>
            </ul>
        </nav>

        <div class="panel panel-primary col-8" 
                    style="
                    position: relative;
                    display: flex;
                    left: 17%;
                    flex-direction: column;
                    padding: 50px 50px;">
            
                        <!-- panel heading starat -->
                        <h2>Halo, <?php echo $userRow['assistantFirstName'];?> <?php echo $userRow['assistantLastName'];?> </h2>
                        <!-- panel heading end -->
        </div> 
                <!-- s -->
    </div>  

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

