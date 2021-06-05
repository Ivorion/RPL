<?php
session_start();

//Cek jika belum login, redirect ke halaman login
if(!isset($_SESSION["username"])){
  header("location: login.php");
}

function angogotaSessionCheck(){
  if(!isset($_SESSION["anggota"])){
    header("location: login.php");
  } 
}

