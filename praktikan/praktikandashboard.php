<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
    // include_once 'connection/server.php';
    if(!isset($_SESSION['praktikanSession']))
    {
        // header("Location: ../index.php");
    }
    $usersession = $_SESSION['praktikanSession'];
    $res = mysqli_query($con,"SELECT * FROM praktikan WHERE praktikanNRP=".$usersession);
    $userRow  = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome <?php echo $userRow['praktikanName'];?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/simplebar@2.4.3/dist/simplebar.css"/>
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body class="hero-anime">
    <header>
        <div class="navigation-wrap start-header start-style">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md navbar-light">
                        
                            <a class="navbar-brand" href="praktikandashboard.php" target="_blank"><img src="assets/img/logo.png" alt=""></a>	
                            
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item active pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link active" href="praktikandashboard.php">Dashboard</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="materi.php">Materi</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="asisten.php">Asisten</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="praktikanlogout.php?logout">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                            
                        </nav>		
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main id="wrapper" class="colorOne" data-simplebar>
            <div class="section full-height">
                <div class="absolute-center2">
                    <div class="section">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-2">
                                        <svg viewBox="0 0 1350 600">
                                            <text x="50%" y="50%" fill="transparent" text-anchor="middle">Halo, <?php echo $userRow['praktikanName'];?></text>
                                        </svg>
                                    </div>
                                    <div style="
                                        position: absolute;
                                        left: 50%;
                                        top: 52%;
                                        transform: translateX(-50%);
                                        ">
                                    <p class="mb-4" style="font-size: 1.5em;">lihat jadwalmu</p>
                                    <a href="#startchange"><i class="fas fa-arrow-circle-down" style="font-size:48px; color:#212112; position:absolute;
                                        left: 50%; transform: translateX(-50%);"></i></a>
                                    </div>
                                </div>	
                            </div>		
                        </div>		
                    </div>
                </div>
            </div>
        
            <div class="section full-height jadwal" id="startchange">
                <div class="absolute-center">
                    <div class="section">
                        <div class="container">
                            <div class="row ">
                                <div class="col-8">
                                    <div class="">
                                        <div class="mb-4">
                                            <div class="table-responsive">
                                                <div class="mb-2">
                                                    <h3><b>Jadwal Praktikum Kelompok <?php echo $userRow['praktikanKelompok'];?></b></h3>
                                                </div>
                                                <table class="table table-borderless">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Praktikum</th>
                                                            <th scope="col">Tanggal</th>
                                                            <th scope="col">Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                        $kelompok = $userRow['praktikanKelompok'];
                                                        $result = mysqli_query($con, "SELECT * FROM `jadwalpraktikum` 
                                                        WHERE kelompok = '$kelompok'");
                                                        while($jadwalpraktikum = mysqli_fetch_array($result)){
                                                            echo "<tbody>";
                                                                echo "<tr>";
                                                                // echo "<td>" . $jadwalpraktikum['assist_NRP'] . "</td>";
                                                                echo "<td>" . $jadwalpraktikum['praktikum'] . "</td>";
                                                                    echo "<td>" . $jadwalpraktikum['tanggal'] . "</td>";
                                                                    echo "<td>" . $jadwalpraktikum['jam'] . "</td>";  
                                                        } 
                                                                echo "</tr>";
                                                            echo "</tbody>";              
                                                    echo "</table>";
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="table-responsive">
                                                <div class="mb-2">
                                                    <h3><b>Jadwal Asistensi Kelompok <?php echo $userRow['praktikanKelompok'];?></b></h3>
                                                </div>
                                                <table class="table table-borderless">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Asistensi</th>
                                                            <th scope="col">Tanggal</th>
                                                            <th scope="col">Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                        $result = mysqli_query($con, "SELECT a.*, b.id, b.jadwalTanggal, b.jadwalHari, b.mulai, b.selesai 
                                                        FROM asistensi a INNER JOIN jadwalasisten b  
                                                            ON a.jadwalId = b.id
                                                            where a.kelompok = '$kelompok'");
                                                        while($jadwalpraktikum = mysqli_fetch_array($result)){
                                                            echo "<tbody>";
                                                                echo "<tr>";
                                                                // echo "<td>" . $jadwalpraktikum['assist_NRP'] . "</td>";
                                                                echo "<td>" . $jadwalpraktikum['praktikum'] . "</td>";
                                                                    echo "<td>" . $jadwalpraktikum['jadwalTanggal'] . "</td>";
                                                                    echo "<td>" . $jadwalpraktikum['mulai'] . "</td>";  
                                                        } 
                                                                echo "</tr>";
                                                            echo "</tbody>";              
                                                    echo "</table>";
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <img src="assets/img/peep-46.png" class="peep-laptop img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
        </main>

    <script src="assets/js/index.js"></script>
    </body>
</html>