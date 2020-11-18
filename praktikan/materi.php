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
        <title>Materi</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.4/pdfobject.min.js" integrity="sha512-mW7siBAOOJTkMl77cTke1Krn+Wz8DJrjMzlKaorrGeGecq0DPUq28KgMrX060xQQOGjcl7MSSep+/1FOprNltw==" crossorigin="anonymous"></script>
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body class="hero-anime">

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
    </header>
        <div data-barba="container" data-barba-namespace="materi">
            <div class="page__wrapper magazine" >

                <div class="page page-cover active">
                    <div class="controls">
                        <i class="fas fa-arrow-circle-right next js-next" style="font-size:48px;"></i>
                    </div>
                    <h1 class="">Modul LAB 1 : Dasar Rangkaian Digital</h1>
                    <div class="col-12 viewpdf" id="pdf1"></div>
                </div>
                
                <div class="page page-2">
                    <div class="controls">
                        <i class="fas fa-arrow-circle-left next js-prev" style="font-size:48px;"></i>
                        <i class="fas fa-arrow-circle-right next js-next" style="font-size:48px;"></i>
                    </div>
                    <h1>Modul LAB 2 : Decoder, Demultiplexer dan Multiplexer</h1>
                    <div class="col-12 viewpdf" id="pdf2"></div>
                </div>

                <div class="page page-4">
                    <div class="controls">
                        <i class="fas fa-arrow-circle-left next js-prev" style="font-size:48px;"></i>
                        <i class="fas fa-arrow-circle-right next js-next" style="font-size:48px;"></i>
                    </div>
                    <h1>Modul LAB 4 : Rangkaian Logika Sekuensial</h1>
                    <div class="col-12 viewpdf" id="pdf4"></div>
                </div>
        
                <div class="page page-5">
                    <div class="controls">
                        <i class="fas fa-arrow-circle-left next js-prev" style="font-size:48px;"></i>
                        <i class="fas fa-arrow-circle-right next js-back-to-1" style="font-size:48px;"></i>
                    </div>
                    <h1>Modul LAB 5 : Register, Synchronous Counter dan Asynchronous Counter</h1>
                    <div class="col-12 viewpdf" id="pdf5"></div>
                </div>
            </div>
        </div>
        
    
    
    <script src="assets/js/index.js"></script>
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

        //pdf 
        PDFObject.embed("LAB1.pdf", "#pdf1")
        PDFObject.embed("LAB2.pdf", "#pdf2");
        PDFObject.embed("LAB4.pdf", "#pdf4");
        PDFObject.embed("LAB5.pdf", "#pdf5");

        //next slide
        $('.js-next').on('click', function() {
            var current = $('.page.active');
            var findNext = $(current).next(".page");
            $(current).removeClass('active');
            setTimeout(function() {
                $(findNext).addClass("active");
            }, 200);
        });

        $('.js-prev').on('click', function() {
            var current = $('.page.active');
            var findPrev = $(current).prev(".page");
            $(current).removeClass('active');
            setTimeout(function() {
                $(findPrev).addClass("active");
            }, 200);
        });

        $('.js-back-to-1').on('click', function() {
            var current = $('.page.active');
            $(current).removeClass('active');
            setTimeout(function() {
                $('.page-cover').addClass("active");
            }, 400);
        });

        })(jQuery); 
	</script>
    </body>
</html>