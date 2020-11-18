<?php
    include_once '../assets/conn/dbconnect.php';

    session_start();

    if (isset($_SESSION['assitantSession']) != "") {
        header("Location:index.php");
    }

    if (isset($_POST['login'])) {
        $asistenNRP = mysqli_real_escape_string($con,$_POST['asistenNRP']);
        $password  = mysqli_real_escape_string($con,$_POST['password']);

        $res = mysqli_query($con,"SELECT * FROM asisten WHERE asistenNRP = '$asistenNRP'");
        $row=mysqli_fetch_array($res,MYSQLI_ASSOC);

        if ($row['password'] == $password){
            $_SESSION['assistantSession'] = $row['asistenNRP'];
            ?>
                <script type="text/javascript">
                    alert('Login Success');
                </script>
            <?php
            header("Location:index.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Asisten</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: #252B37;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="form user" role="form" method="POST" accept-charset="UTF-8">
                                        <div class="form-group">
                                            <label for="inputNRP">NRP : </label>
                                            <input name="asistenNRP" type="text"  class="form-control" required>
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
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>