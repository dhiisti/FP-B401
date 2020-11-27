<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
    $usersession = $_SESSION['praktikanSession'];

    if (isset($_GET['id'])) {
		$id = $_GET['id'];
    }

    $res = mysqli_query($con," SELECT * FROM asistensi WHERE jadwalId=$id ");
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

    IF (isset($_POST['asistensi'])){
		$jadwalId = mysqli_real_escape_string($con,$id);
		
        // name of the uploaded file
        $filename = $_FILES['myfile']['name'];

        // destination of the file on the server
        $destination = 'uploads/' . $filename;

        // get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['myfile']['tmp_name'];
        $size = $_FILES['myfile']['size'];
        
        if(file_exists($file)) {
        }
          // Upload image only if no errors
        if (empty($error)) {
            if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                echo "You file extension must be .zip, .pdf or .docx";

            } else if ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
                echo "File too large!";

            } else {
                if(move_uploaded_file($file, $destination)){
                    $res = mysqli_query($con, "UPDATE asistensi SET name='$filename', size='$size' , downloads=0 WHERE jadwalId=$jadwalId");
                    if ($res){
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
                        header("Location: praktikandashboard.php");
                    }
                } else {
                    echo "failed to upload";
                }
            }
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
                                    <h2 >Upload File Laporan</h2>
                                    <hr class="mb-4">

                                    <form class="form" role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                       
                                        <div class="form-group">
                                            <label for="praktikum" class="control-label">LAB ke :</label>
                                            <h5 class="card-title"><?php echo $userRow['praktikum'] ?></h5>
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