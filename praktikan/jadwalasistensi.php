<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
    $usersession = $_SESSION['praktikanSession'];

    if (isset($_GET['jadwalTanggal']) && isset($_GET['id'])) {
		$tanggal =$_GET['jadwalTanggal'];
		$id = $_GET['id'];
    }

    $res = mysqli_query($con," SELECT a.*, b.* FROM jadwalasisten a INNER JOIN praktikan b 
    WHERE a.jadwalTanggal='$tanggal' AND id=$id AND b.praktikanNRP=$usersession ");
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

    IF (isset($_POST['asistensi'])){
        $assistid = mysqli_real_escape_string($con, $userRow['asistenNRP']);
        $kelompok = mysqli_real_escape_string($con,$userRow['praktikanKelompok']);
		$jadwalId = mysqli_real_escape_string($con,$id);
		$praktikum = mysqli_real_escape_string($con,$_POST['praktikum']);
		$avail = "Not Available";

        // name of the uploaded file
        $filename = $_FILES['myfile']['name'];

        // destination of the file on the server
        $destination = 'uploads/' . $filename;

        // get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['myfile']['tmp_name'];
        $size = $_FILES['myfile']['size'];
        

		$query = "INSERT INTO asistensi (  asistenNRP , kelompok , jadwalId , praktikum, name, size, downloads)
        VALUES ( '$assistid', '$kelompok', '$jadwalId', '$praktikum', '$filename', $size, 0) ";
        $result = mysqli_query($con,$query);

        $query2 = "UPDATE jadwalasisten SET status = '$avail' WHERE id=$jadwalId";
        $result2 = mysqli_query($con, $query2);

        // $query3 = "INSERT INTO files () VALUES ()";
        // $result3 = mysqli_query($con, $query3);
        
        if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
            echo "You file extension must be .zip, .pdf or .docx";
        } else if ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
            echo "File too large!";
        } else {
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
                if ( $result ){
                    ?>
                    <script type="text/javascript">
                        alert('Appointment made successfully.');
                    </script>
                    <?php
                    header("Location: praktikandashboard.php");
                }else{
                    echo mysqli_error($con);
                    ?>
                        <script type="text/javascript">
                            alert('Appointment booking fail. Please try again.');
                        </script>
                    <?php
                    header("Location: asisten.php");
                }
            } else {
                echo "failed to upload";
            }
        }

        if($query2){
            $btn = "disable";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body style="background-color: #EDE6F2;">
        <main>
            <div class="section full-height">
                <div class="absolute-center2">    
                    <div class="section">
                        <div class="container">  
                            <div class="col-12">
                                    <form class="form" role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                        <div class="card bg-light mb-3">
                                            <div class="card-header">Praktikan</div>
                                            <div class="card-body">
                                                <h5 class="card-title">Nama Praktikan : <?php echo $userRow['praktikanName'] ?></h5>
                                                <h5 class="card-title">NRP : <?php echo $userRow['praktikanNRP'] ?></h5>
                                                <h5 class="card-title">Kelompok : <?php echo $userRow['praktikanKelompok'] ?></h5>
                                            </div>
                                        </div>

                                        <div class="card bg-light mb-3">
                                            <div class="card-header">Tanggal Asistensi</div>
                                            <div class="card-body">
                                                <h5 class="card-title">Hari : <?php echo $userRow['jadwalHari'] ?></h5>
                                                <h5 class="card-title">Tanggal : <?php echo $userRow['jadwalTanggal'] ?></h5>
                                                <h5 class="card-title">Jam : <?php echo $userRow['mulai'] ?> - <?php echo $userRow['selesai'] ?></h5>
                                                <h5 class="card-title">Asisten : <?php echo $userRow['asistenNRP'] ?></h5>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="praktikum" class="control-label">LAB ke :</label>
                                            <select class="select form-control" id="praktikum" name="praktikum" required style="font-size:1em;">
                                                    <option value="LAB 1">LAB 1</option>
                                                    <option value="LAB 2">LAB 2</option>
                                                    <option value="LAB 3">LAB 3</option>
                                                    <option value="LAB 4">LAB 4</option>
                                                    <option value="LAB 5">LAB 5</option>
                                                    
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="praktikum" class="control-label">Upload File</label>
                                            <input type="file" name="myfile">
                                            <small id="emailHelp" class="form-text">*jenis file  zip, rar, dan pdf</small> 
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="asistensi" jd="submit" value="Make Appointment" style="width: 100px; height:30px; font-size: 1em;">Submit</button>
                                    </form>
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Barba Core -->
    <script src="https://unpkg.com/@barba/core"></script>
    <!-- GSAP for animation -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js"></script>
</body>
</html>