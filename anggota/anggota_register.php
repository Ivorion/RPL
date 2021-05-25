<?php include 'proses_anggota_register.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Anggota</title>
</head>
<body>
    <div class="register">
        <h1>Get Started</h1>
       
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
        
        <h3>Already have an account? <a href="anggota_login.php">Sign In</a></h5>
        <form action='' method='POST'>
            <table cellpadding="8">
            <tr>
                <td>Username: </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input type='text' name="email"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type='password' name="password"></td>
            </tr>
            </table>
            <hr>
            <button type='submit' name='submit'>Sign Up</button>
        </form>
    </div>
</body>
</html>