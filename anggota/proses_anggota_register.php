<?php

require_once '../koneksi.php';

$errors = array();
$success = array();

if(isset($_POST["submit"])){
    
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    //Check Data
    if(empty($username)){$errors[] = "Username tidak boleh kosong";}
    if(empty($email)){$errors[] = "Email tidak boleh kosong";}
    if(empty($password)){$errors[] = "Password tidak boleh kosong";}


    //Mengecek apakah email atau username sudah ada di database atau belum
    $queryString = "SELECT * FROM anggota_login WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($queryString);
    $user = $result->fetch_assoc();

    if($user){
        if($user["username"] == $username){
            $errors[] = "Username sudah terdaftar";
        }

        if($user["email"] === $email){
            $errors[] = "Email sudah terdaftar";
        }
    }

    if(strlen($password) < 4){
        $errors[] = "Password harus lebih dari 4";
    }

    if(count($errors) == 0){
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $result = $conn->query("INSERT INTO anggota_login (id, username, email, password) VALUES ('', '$username', '$email', '$hash_password')");
        $success[] = "Berhasil Mendaftar";
    }
}
