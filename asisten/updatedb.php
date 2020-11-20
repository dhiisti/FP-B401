<?php
    include_once '../assets/conn/dbconnect.php';
    // Get the variables.
    $jadwalId = $_GET['jadwalId'];
    $checked = $_GET['checked'];

    $update = mysqli_query($con,"UPDATE asistensi SET status='done' WHERE jadwalId=$jadwalId");
?>