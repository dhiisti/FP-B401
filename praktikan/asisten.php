<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';

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
<body class="hero-anime" style="background-color: #D2E4C4;">

    <div class="loading-container">
      <div class="loading-screen">
      </div>
    </div>

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
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="praktikandashboard.php">Dashboard</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="materi.php">Materi</a>
                                    </li>
                                    <li class="nav-item active pl-4 pl-md-0 ml-0 ml-md-4">
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

    <div data-barba="wrapper">
        <main data-barba="container" data-barba-namespace="asisten">
            <div class="section full-height">
                <div class="absolute-center2">
                    <div class="section">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="ml-4">Kelompok <?php echo $userRow['praktikanKelompok'];?>, pilih asistenmu !</h2>
                                    <div class="form-group col-6">
                                        <label>NRP</label>
                                        <input class="form-control" type="text" id="nrp" name="nrp" onchange="showUser(this.value)"/>
                                        <small id="emailHelp" class="form-text">Masukan NRP tanpa 0 (ex: 72118)</small>  
                                    </div>
                                    <div class="col-xs-12 col-md-8">
                                        <div id="jadwal"></div>
                                    </div>
                                </div>	
                            </div>	
                        </div>
        
                            <script>
                                function showUser(str){			
                                    if (str == "") {
                                        document.getElementById("jadwal").innerHTML = "No data to be shown";
                                        return;
                                    } else {
                                        if (window.XMLHttpRequest) {
                                            // code for IE7+, Firefox, Chrome, Opera, Safari
                                            xmlhttp = new XMLHttpRequest();
                                        } else {
                                            // code for IE6, IE5
                                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                        }
        
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById("jadwal").innerHTML = xmlhttp.responseText;
                                        }
                                    };
        
                                    xmlhttp.open("GET","getschedule.php?q="+str,true);
                                    console.log(str);
                                    xmlhttp.send();
        
                                    }
                                }
                            </script>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Barba Core -->
     <script src="https://unpkg.com/@barba/core"></script>
    <!-- GSAP for animation -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js"></script>
    <script>		
        (function($) { "use strict";
            
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