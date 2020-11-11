<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
   
    if(!isset($_SESSION['assistantSession']))
    {
        // header("Location: ../index.php");
    }

    $usersession = $_SESSION['assistantSession'];
    $res = mysqli_query($con,"SELECT * FROM asisten WHERE asistenNRP=".$usersession);
    $userRow  = mysqli_fetch_array($res, MYSQLI_ASSOC);

    //ADD SCHEDULEs
    if(isset($_POST['submit'])) {
        $tanggal = mysqli_real_escape_string($con, $_POST['tanggal']);
        $hari = mysqli_real_escape_string($con, $_POST['hari']);
        $mulai = mysqli_real_escape_string($con, $_POST['mulai']); 
        $selesai = mysqli_real_escape_string($con, $_POST['selesai']);
        $status = mysqli_real_escape_string($con, $_POST['status']);
        $nrp = mysqli_real_escape_string($con, $userRow['asistenNRP']);

        $query = "INSERT INTO jadwalasisten (asistenNRP, jadwalTanggal, jadwalHari, mulai, selesai,  status ) 
        VALUES ('$nrp', '$tanggal', '$hari','$mulai', '$selesai', '$status')";

        $result = mysqli_query($con, $query);

        if($result){
            ?>
            <script type="text/javascript">
                alert('Success');
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
                alert('Failed');
            </script>
            <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Welcome <?php echo $userRow['assistantFirstName'];?> <?php echo $userRow['assistantLastName'];?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    
    <body>

        <div class="wrapper ">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="assets/img/logo.png" id="logo">
            </div>

            <ul class="list-unstyled components">
                <p>Halo, <?php echo $userRow['asistenNama'];?></p>
                <li class="active">
                    <a href="addschedule.php"><i class="far fa-cselesaiar-plus mr-md-4" ></i>Tambah Jadwal</a>
                </li>
                <li>
                    <a href="assistantdashboard.php"><i class="far fa-cselesaiar-alt mr-md-4"></i>Jadwal Asistensi</a>
                </li>
                <li>
                    <a href="asistenlogout.php?logout"><i class="fas fa-power-off mr-md-4"></i>Log Out</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <!-- <div id="content ">
                <div class="container-fluid"> -->
                <div class="panel panel-primary col-8" 
                    style="
                    position: relative;
                    display: flex;
                    left: 17%;
                    flex-direction: column;
                    padding: 50px 50px;">
            
                        <!-- panel heading starat -->
                        <div>
                            <h3>Tambah Jadwal :</h3>
                        </div>
                        <!-- panel headinselesai -->
            
                        <div class="">
                            <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tanggal">Tanggal :</label>
                                        <input class="form-control" id="tanggal" name="tanggal" type="date" required/>
                                    </div>
                
                                    <div class="form-group col-md-6">
                                        <label for="hari">Hari :</label>
                                        <select class="select form-control" id="hari" name="hari" required>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="mulai">Mulai :</label>
                                        <input class="form-control" type="time" id="mulai" name="mulai" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="selesai">Selesai :</label>
                                        <input class="form-control" type="time" id="selesai" name="selesai" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2 requiredField" for="status">Availabilty</label>
                                    <select class="select form-control" id="status" name="status" required>
                                        <option value="Available">Available</option>
                                        <option value="Not Available">Not Available</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label col-sm-2 requiredField" for="nrp">NRP</label>
                                    <input class="form-control" type="text" id="nrp" name="nrp" value="<?php echo $userRow['asistenNRP'];?>" required>
                                </div> -->
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                        <br/>
                        <!-- Table -->
                        <div>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <?php
                            $result = mysqli_query($con, "SELECT * FROM jadwalasisten where asistenNRP =".$usersession);
                            
                            while($jadwalasisten = mysqli_fetch_array($result)){
                                echo "<tbody>";
                                    echo "<tr>";
                                    // echo "<td>" . $assistantschedule['asistenNRP'] . "</td>";
                                    echo "<td>" . $jadwalasisten['jadwalTanggal'] . "</td>";
                                        echo "<td>" . $jadwalasisten['jadwalHari'] . "</td>";
                                        echo "<td>" . $jadwalasisten['mulai'] . "</td>";
                                        echo "<td>" . $jadwalasisten['selesai'] . "</td>";
                                        echo "<td>" . $jadwalasisten['status'] . "</td>";
                                        echo "<form method='POST'>";
                                        echo "<td><a href='#' id='".$jadwalasisten['id']."'class='delete'><i class='fas fa-trash' style='color:red;'></i></a>
                                        </td>";     
                                    } 
                                    echo "</tr>";
                                    echo "</tbody>";
                                    
                                    echo "</table>";
                                    // echo "<div class='panel panel-default'>";
                                    //     echo "<div class='col-md-offset-3 pull-right'>";
                                    //         echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
                                    //     echo "</div>";
                                    // echo "</div>";
                                    ?>
                        </div>
                    </div> 
                <!-- s -->
        </div>  

<script type="text/javascript">
    $(function() {
        $(".delete").click(function(){
            var element = $(this);
            var id = element.attr("id");
            var info = 'id=' + id;
            
            if(confirm("Are you sure you want to delete this?")){
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: info,
                    success: function(){
                    }
                });
                $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
            }
            return false;
        });

        $("#sidebar").mCustomScrollbar({
         theme: "minimal"
        });
    });
</script>

    </body>
</html>

