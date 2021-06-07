<?php include 'proses_anggota_register.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="anggota_register.css">
    <title>Register Anggota</title>
</head>
<body>
    <div class="images">
        <img class='image' src="images/Mar-Business_16.jpg" alt="">
    </div>
    <div class="register">
        <h1 class='get-started'>Get Started</h1>
       
        <?php 
            if(count($errors) > 0) {
                foreach($errors as $error){
                    echo $error . "<br>";
                }
            }

            if(count($success) > 0){
                echo $success[0];
            }
        ?>
        
        <h3 class='caution'>Already have an account? <a href="anggota_login.php">Sign In</a></h5>
        <form action='proses_anggota_register.php' method='POST'>
            <table cellpadding="8">
            <tr>
                <td class='username'>Username: </td>
            </tr>
            <tr>
                <td><input  class='input-username' type="text" name="username"></td>
            </tr>
            <tr>
                <td class='email'>Email: </td>
            </tr>
            <tr>
                <td><input class='input-email' type='text' name="email"></td> 
            </tr>
            <tr>
                <td class='password'>Password: </td>                
            </tr>
            <tr>
                <td><input class='input-password' type='password' name="password"></td>
            </tr>
            </table>
            <button type='submit' name='submit' class='sign-up-button'>Sign Up</button>
        </form>
    </div>
</body>
</html>