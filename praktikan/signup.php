<?php
include_once '../assets/conn/dbconnect.php';
?>

<!-- register -->
<?php
if (isset($_POST['signup'])) {
    $praktikanName = mysqli_real_escape_string($con,$_POST['praktikanName']);
    $praktikanEmail = mysqli_real_escape_string($con,$_POST['praktikanEmail']);
    $praktikanNRP = mysqli_real_escape_string($con,$_POST['praktikanNRP']);
    $praktikanKelompok = mysqli_real_escape_string($con,$_POST['praktikanKelompok']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    //INSERT
    $query = " INSERT INTO praktikan ( praktikanNRP, password, praktikanName, praktikanKelompok, praktikanEmail )
    VALUES ( '$praktikanNRP', '$password', '$praktikanName', '$praktikanKelompok', '$praktikanEmail' ) ";
    $result = mysqli_query($con, $query);

    // echo $result;
    if( $result ){
        ?>
            <script type="text/javascript">
                alert('Register success. Please Login to make an appointment.');
            </script>
        <?php
         header("Location: login.php");
    }else{
        ?>
            <script type="text/javascript">
                alert('User already registered. Please try again');
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
        <title>Sign Up</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body class="log-in">
        <div class="container form-container col-6">
            <div class="justify-content-center">
                <div class="">
                    <h2><img src="assets/img/4.png" 
                             style="width: 70px;height:70px;
	                                object-fit:cover;
	                                border:5px solid #E8E1E1;
	                                border-radius:50%;">Registrasi</h2>
                    <hr/>
                </div>
                <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form" name="form1">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Nama : </label>
                            <input type="text" name="praktikanName" value="" class="form-control input-lg" id="inputName" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNRP">NRP :</label>
                            <input type="text" name="praktikanNRP" value="" class="form-control input-lg" id="inputNRP" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email :</label>
                        <input type="email" name="praktikanEmail" value="" class="form-control input-lg" id="inputEmail" required/>
                    </div>
                    <div class="form-group">
                        <label for="inputKelompok">Nama Kelompok :</label>
                        <input type="text" name="praktikanKelompok" value="" class="form-control input-lg" id="inputKelompok" required/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="password" name="password" value="" class="form-control input-lg" id="password" required />
                        <span id='message'></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password :</label>
                        <input type="password" name="confirm_password" value="" class="form-control input-lg" id="confirm_password" required/>
                        <span id='message2'></span>
                    </div>
                    <button type="submit" name="signup" id="signup" class="btn btn-primary">Sign Up</button>
                </form>
            </div>		
        </div>
        <script>
            $('#password').on('keyup', function(){
                var passw=  /^[A-Za-z]\w{7,14}$/;
                if($(this).val().match(passw)) { 
                    $('#message').html('Strong Enough').css('color', 'lime');
                }else{ 
                    $('#message').html('Not Strong Enough').css('color', 'red');
                }
            });

            $('#confirm_password').on('keyup', function () {
                if ($(this).val() == $('#password').val()) {
                    $('#confirm_password').css('border-color', 'lime');
                    $('#message2').html('Match').css('color', 'lime');
                } 
                else{
                    $('#confirm_password').css('border-color', 'red');
                    $('#message2').html('Not Match').css('color', 'red');
                }
            });

        </script>s
    </body>
</html>
