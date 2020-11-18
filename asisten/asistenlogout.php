<?php
session_start();
    if(!isset($_SESSION['assistantSession'])){
        header("Location: assistantdashboard.php");
    }
    else if(isset($_SESSION['assistantSession'])!=""){
        header("Location: asistenlogin.php");
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['assistantSession']);
        header("Location: asistenlogin.php");
    }
?>