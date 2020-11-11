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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body class="hero-anime">
    <div class="navigation-wrap start-header start-style">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md navbar-light">
					
						<a class="navbar-brand" href="https://front.codes/" target="_blank"><img src="assets/img/logo.png" alt=""></a>	
						
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="praktikandashboard.php">Dashboard</a>
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

    <div class="section full-height">
        <div class="absolute-center">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                <h1><span>H</span><span>a</span><span>l</span><span>o</span><span>,</span>
                <span>P</span><span>r</span><span>a</span><span>k</span><span>t</span><span>i</span><span>k</span><span>a</span><span>n</span></h1>
                <p>Praktikum Rangkaian Digital B401</p>	
                        </div>	
                    </div>		
                </div>		
            </div>
        </div>
    </div>

    <div class="section full-height jadwal">
            <div class=judul_gambar>
                <div class="judul">
                    <h1>Jadwal</h1> 
                    <h1>Kelompok <?php echo $userRow['praktikanKelompok'];?></h1>
                </div>
                <img src="assets/img/peep-46.png" class="peep-laptop">
            </div>
            <div class="col-md-4 tabel">
            <table class="table table-borderless">
                <thead>
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
            <div class="col-md-4 tabel-2">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Praktikum</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                    </tr>
                </thead>
                <?php
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
    <script src="assets/js/jquery.js"></script>

    <script>		
        (function($) { "use strict";
        //Animation

        $(document).ready(function() {
            $('body.hero-anime').removeClass('hero-anime');
        });

        //Menu On Hover
        $('body').on('mouseenter mouseleave','.nav-item',function(e){
                if ($(window).width() > 750) {
                    var _d=$(e.target).closest('.nav-item');_d.addClass('show');
                    setTimeout(function(){
                    _d[_d.is(':hover')?'addClass':'removeClass']('show');
                    },1);
                }
        });	
        })(jQuery); 
	</script>
    </body>
</html>