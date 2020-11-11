<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
    $q = $_GET['q'];
    $res = mysqli_query($con,"SELECT * FROM jadwalasisten WHERE asistenNRP='$q'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jadwal Asisten</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet">
</head>
    <body>
        <?php
        echo $q;
        if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-danger' role='alert'>Belum ada jadwal yang terinput</div>";
        
        } else {
        echo "   <table class='table table-hover'>";
            echo " <thead>";
                echo " <tr>";
                    echo " <th>Id</th>";
                    echo " <th>Hari</th>";
                    echo " <th>Tanggal</th>";
                    echo "  <th>Mulai</th>";
                    echo "  <th>Selesai</th>";
                    echo " <th>Status</th>";
                    echo "  <th>Book Now!</th>";
                echo " </tr>";
            echo "  </thead>";
            echo "  <tbody>";
                while($row = mysqli_fetch_array($res)) {
                ?>
                <tr>
                    <?php
                        // $avail=null;
                        // $btnclick="";
                        if ($row['status']!='Available') {
                            $avail="danger";
                            $btnstate="disabled";
                            $btnclick="danger";
                        } else {
                            $avail="primary";
                            $btnstate="";
                            $btnclick="primary";
                    }

                   
                    // if ($rowapp['bookAvail']!="available") {
                    // $btnstate="disabled";
                    // } else {
                    // $btnstate="";
                    // }
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['jadwalHari'] . "</td>";
                    echo "<td>" . $row['jadwalTanggal'] . "</td>";
                    echo "<td>" . $row['mulai'] . "</td>";
                    echo "<td>" . $row['selesai'] . "</td>";
                    echo "<td> <span class='label label-".$avail."'>". $row['status'] ."</span></td>";
                    echo "<td><a href='jadwalasistensi.php?&id=" . $row['id'] . "&jadwalTanggal=" .$row['jadwalTanggal']."' class='btn btn-".$btnclick." btn-xs' role='button' ".$btnstate.">Book Now</a></td>";
                    // echo "<td><a href='appointment.php?&appid=" . $row['scheduleId'] . "&scheduleDate=".$q."'>Book</a></td>";
                    // <td><button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#exampleModal'>Book Now</button></td>";
                    //triggered when modal is about to be shown
                    ?>
                    
                    <!-- ?> -->
                </tr>
                
                <?php
                }
                }
                ?>
            </tbody>
            <!-- modal start -->
        </body>
    </html>