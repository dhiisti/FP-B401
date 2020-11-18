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
    <body>
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
    <!-- <?php
        echo $tanggal;echo "<br>";
        echo $id;echo "<br>";
        echo $usersession;echo "<br>";
        echo $userRow['praktikanName'];echo "<br>";
        echo $userRow['praktikanNRP'];echo "<br>";
        echo $userRow['praktikanKelompok'];echo "<br>";
        echo $userRow['scheduleDate'];echo "<br>";
        echo $userRow['startTime'];echo "<br>";
        echo $userRow['endTime'];echo "<br>";
        echo $userRow['scheduleDay'];echo "<br>";

    ?> -->
    <div class="section full-height">
        <div class="absolute-center">    
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
                                    <select class="select form-control" id="praktikum" name="praktikum" required>
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
                                    <small id="file" class="form-text">*jenis file pdf, zip</small>
                                </div>
                                <button type="submit" class="btn btn-primary" name="asistensi" jd="submit" value="Make Appointment">Submit</button>
                            </form>
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
    </body>
</html>