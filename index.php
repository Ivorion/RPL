<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="landingPage/style.css">
    <title>Aplikasi Simpan Pinjam</title>
</head>
<body>

    <div class="navbar">
        <button class="about-us">About Us</button>
        <button class="sign-up">Sign Up</button>
        <button class="sign-in">Sign In</button>
    </div>
    
    <div class="image-container">
        <img src="7849.jpg" alt="" class="images">
    </div>
    

    <div class="circle1"></div>
    <div class="circle2"></div>

    <div class="nav-title">ASP.</div>

    <div class="title">
        <h1 class='text-aplikasi'>Aplikasi</h1>
        <h1 class="text-simpan">Simpan</h1>
        <h1 class="text-pinjam">Pinjam</h1>
        <p class='description-title'>
            Sebuah aplikasi sederhana dimana anda bisa menyimpan dan meminjam uang
        </p>
    </div>
    
</body>
<script>
    let signIn = document.querySelector(".sign-in");
    signIn.addEventListener('click',function(){
        window.location.href = 'anggota/anggota_login.php';
    })
</script>
</html>