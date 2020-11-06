<?php
include_once '../assets/conn/dbconnect.php';

session_start();

if (isset($_SESSION['assitantSession']) != "") {
    header("Location: addschedule.php");
}

if (isset($_POST['login'])) {
    $assistantNRP = mysqli_real_escape_string($con,$_POST['assistantNRP']);
    $password  = mysqli_real_escape_string($con,$_POST['password']);

    $res = mysqli_query($con,"SELECT * FROM assistant WHERE assistantNRP = '$assistantNRP'");
    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);

    if ($row['password'] == $password){
        $_SESSION['assistantSession'] = $row['assistantNRP'];
        ?>
            <script type="text/javascript">
                alert('Login Success');
            </script>
        <?php
        header("Location: addschedule.php");
    } else {
        ?>
            <script type="text/javascript">
                // alert("Login Failed");
                $('#message').html('Not Matching').css('color', 'red');
                // $('#inputPassword').css('border-color', 'red');
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
        <title>Login Asisten</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body class="log-in" style="background-color: #D6B370;">
        <div class="container form-container col-4" style="padding: 50px;">
            <div class="justify-content-center">
                <form class="form" role="form" method="POST" accept-charset="UTF-8">
                    <div class="form-group">
                        <label for="inputNRP">NRP : </label>
                        <input name="assistantNRP" type="text"  class="form-control" required>
                        <small id="emailHelp" class="form-text text-muted">Masukan NRP tanpa 0 (ex: 72118)</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password : </label>
                        <input name="password" type="password" class="form-control" id="inputPassword" required>
                        <span id='message'></span>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>		
        </div>		
        <img src="assets/img/girl.png" style="position: absolute; bottom:0px; width: 500px; left: 350px;">
        <img src="assets/img/boy.png" style="position: absolute; bottom:0px; width: 500px; left: 50px;">
        <div class="copyright" style="margin-right: 80px;">
            <p>B401&#169;2020</p>
        </div>
    </body>
</html>