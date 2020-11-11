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

    if (isset($_GET['file_id'])) {
        $id = $_GET['file_id'];
        echo $id;
        // fetch file to download from database
        $sql = "SELECT * FROM asistensi WHERE jadwalId=$id";
        $result = mysqli_query($con, $sql);
  
        $file = mysqli_fetch_assoc($result);
        $filepath = '..s/praktikan/uploads/' . $file['name'];
  
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('../praktikan/uploads/' . $file['name']));
            readfile('../praktikan/uploads/' . $file['name']);
  
            // Now update downloads count
            $newCount = $file['downloads'] + 1;
            $updateQuery = "UPDATE asistensi SET downloads=$newCount WHERE id=$id";
            mysqli_query($con, $updateQuery);
            exit;
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
        <title>Welcome <?php echo $userRow['asistenNama'];?></title>
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
                <li>
                    <a href="addschedule.php"><i class="far fa-calendar-plus mr-md-4" ></i>Tambah Jadwal</a>
                </li>
                <li  class="active">
                    <a href="assistantdashboard.php"><i class="far fa-calendar-alt mr-md-4"></i>Jadwal Asistensi</a>
                </li>
                <li>
                    <a href="asistenlogout.php?logout"><i class="fas fa-power-off mr-md-4"></i>Log Out</a>
                </li>
            </ul>
        </nav>

        <div class="panel panel-primary col-8" 
                    style="
                    position: relative;
                    display: flex;
                    left: 17%;
                    flex-direction: column;
                    padding: 50px 50px;">
            
                        <!-- panel heading starat -->
                        <h2>Halo, <?php echo $userRow['asistenNama'];?></h2>
                        <div>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Kelompok</th>
                                    <th scope="col">Lab</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Filename</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Download</th>
                                    <th scope="col">Check</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <?php
                                
                            $result = mysqli_query($con, "SELECT a.*, b.id, b.jadwalTanggal, b.jadwalHari, b.mulai, b.selesai 
                            FROM asistensi a INNER JOIN jadwalasisten b  
                                ON a.jadwalId = b.id
                                where a.asistenNRP = $usersession");
                            
                            while($asistensi = mysqli_fetch_array($result)){
                                if ($asistensi['status']=='process') {
                                    $status="danger";
                                    $icon='remove';
                                    $checked='';

                                } else {
                                    $status="success";
                                    $icon='ok';
                                    $checked = 'disabled';
                                }
                                echo "<tbody>";
                                    echo "<tr>";
                                        echo "<td>" . $asistensi['jadwalId'] . "</td>";
                                        echo "<td>" . $asistensi['kelompok'] . "</td>";
                                        echo "<td>" . $asistensi['praktikum'] . "</td>";
                                        echo "<td>" . $asistensi['jadwalHari'] . "</td>";
                                        echo "<td>" . $asistensi['jadwalTanggal'] . "</td>";
                                        echo "<td>" . $asistensi['mulai'] . "</td>";
                                        echo "<td>" . $asistensi['selesai'] . "</td>";
                                        echo "<td>". $asistensi['name'] ."</td>";
                                        echo "<td>" . $asistensi['status'] . "</td>";
                                        echo "<form method='POST'>";
                                        echo "<td><a href='assistantdashboard.php?file_id=". $asistensi['jadwalId']. "'>Download</a></td>";
                                        echo "<td class='text-center'><input type='checkbox' name='enable' id='enable' value='".$asistensi['jadwalId']."' onclick='chkit(".$asistensi['jadwalId'].",this.checked);' ".$checked."></td>";
                                        echo "<td class='text-center'><a href='#' id='".$asistensi['jadwalId']."' class='delete'><i class='fas fa-trash' style='color:red;'></i></a>
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
                        <!-- panel heading end -->
        </div> 
        <script type="text/javascript">
            function chkit(uid, chk) {
                chk = (chk==true ? "1" : "0");
                var url = "updatedb.php?jadwalId="+uid+"&checked="+chk;
                if(window.XMLHttpRequest) {
                    req = new XMLHttpRequest();
                } else if(window.ActiveXObject) {
                    req = new ActiveXObject("Microsoft.XMLHTTP");
                }
                // Use get instead of post.
                req.open("GET", url, true);
                req.send(null);
            }
        </script>
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

