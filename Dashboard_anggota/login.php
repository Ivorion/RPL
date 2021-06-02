<?php
session_start();

require_once "libraries/database.php";

//Redirect ke index.php jika sudah login
if(isset($_SESSION["username"])){
    header("location: index.php");
}

$error = array();

if(isset($_POST["submit"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $result = $conn->query("SELECT * FROM anggota_login WHERE username='$username'");
    $row = $result->fetch_assoc();

    //Cek apakah username ada di database
    if($row){
        echo $row["password"];
        //Cek apakah password cocok dengan yang ada di database
        if(password_verify($password, $row["password"])){
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["username"];

            header("location: index.php");
        }else{
            $error[] =  "Password salah";
        }
    }else{
        $error[] =  "Username salah";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="resources/css/login_style.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <title>Login</title>
</head>
<body>
<div class="container-fluid px-1">
    <div class="row main-content">
        <div class="col-lg-8  my-auto">
            <div class="card card0">
                <img src="resources/img/loan.jpg" alt="">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card1 p-5">
                <div class="header text-center">
                    <p class="text-large">Sign In</p>
                    <p>Don't have an account? Sign Up</p>
                </div>

                <form id="quickForm" method="POST" action='' class="formLogin">
                    <div class="form-group">
                        <label for="namaLengkap">Username</label>
                        <input type="text" name="username" class="form-control" id="username-input">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Passsword</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-login form-control" name="submit" id="ajukanPinjaman">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
   
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>

<script>

//Validasi form
$(function () {
    $("#quickForm").validate({
        rules: {
            username : {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            username: {
                required: "Username harus diisi"
            },
            password: {
                required: "Password harus diisi"
            },
        },
        errorElement : 'span',
        errorPlacement: function(error, element){
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass){
            $(element).removeClass('is-invalid');
        }
    });
});

let errors = <?= json_encode($error)?>;

if(errors.length > 0){
    toastr.warning(errors[0]);
   
}

</script>
</body>
</html>