<?php
    session_start();

    if(!isset($_SESSION['praktikanSession'])){
        header("Location: praktikandashboard.php");
    }
    else if(isset($_SESSION['praktikanSession'])!=""){
        header("Location: login.php");
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['praktikanSession']);
        header("Location: login.php");
    }
?>