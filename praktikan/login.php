<?php
include_once '../assets/conn/dbconnect.php';

session_start();
    
// if (isset($_SESSION['praktikanSession']) != "") {
//     header("Location: praktikandashboard.php");
// }

if (isset($_POST['login'])){
    $praktikanNRP = mysqli_real_escape_string($con,$_POST['praktikanNRP']);
    $password  = mysqli_real_escape_string($con,$_POST['password']);

    $res = mysqli_query($con,"SELECT * FROM praktikan WHERE praktikanNRP = '$praktikanNRP'");
    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);

    if ($row['password'] == $password){
        $_SESSION['praktikanSession'] = $row['praktikanNRP'];
        ?>
            <script type="text/javascript">
                alert('Login Success');
            </script>
        <?php
        header("Location: praktikandashboard.php");
    }else{
        ?>
            <script type="text/javascript">
                $('#inputPassword').css('border-color', 'red');
                // alert('Login Failed');
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
        <title>Log In</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body class="log-in">
        <!-- <div class="title col-6">
            <h2>Log In Praktikan</h2>
            <hr/>
        </div> -->
        <div class="peep"><img src="assets/img/peep-62.png" id="duduk"></div>
        <div class="container form-container col-4">
            <div class="justify-content-center">
                <form class="form" role="form" method="POST" accept-charset="UTF-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NRP</label>
                        <input name="praktikanNRP" type="text"  class="form-control" required>
                        <small id="emailHelp" class="form-text">Masukan NRP tanpa 0 (ex: 72118)</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1">Password</label>
                        <input name="password" type="password" class="form-control" id="inputPassword" required>
                        <span id='message'></span>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>		
            <p>Belum punya akun? <a href="signup.php">Sign Up</a></p>
        </div>		
        <div class="copy col-10">
            <p class="b401">B401&#169;2020</p>
            <p class="ml-md-4"><a href="../assistant/asistenlogin.php">Asisten</a></p>
        </div>
    </body>
</html>