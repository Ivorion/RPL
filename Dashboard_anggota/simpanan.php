<?php
  require_once 'libraries/session_check.php';
  include_once "libraries/database.php";
  
  $dateNow = date("F j, Y");
  
  $anggota = getDataFromAnggotaById($_SESSION["userid"]);

  //Cek jika belum terdaftar sebagai anggota
  if(is_null($anggota)){
    header("Location: index.php");
  }

  if(isset($_POST["submit"])){
      $nama = $_POST["namaLengkap"];
      $jumlah = $_POST["jumlahSimpanan"];
      $tanggal =date("Y-m-d");
      $kd_anggota = $anggota["kd_anggota"];
      $kd_simpanan = generate_code("simpanan_sementara", "J");

     $result =  $conn->query("INSERT INTO `simpanan_sementara` (`kd_simpanan`, `besar_simpanan`, `tgl_simpanan`, `kd_anggota`) VALUES ('$kd_simpanan', '$jumlah', '$tanggal', '$kd_anggota');");

     if($result){
       $_SESSION["status"] = "Simpanan Berhasil disimpan";
       header("Location: index.php");
     }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simpanan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="resources/css/custom.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <ul class="navbar-nav ml-auto">
      <li class="nav-item mr-4">
        <a href="logout.php" class="nav-link">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="resources/assets/uploads/<?= ($anggota) ? $anggota["foto"] : "no_profile.png"?>" class="img-circle elevation-2" alt="User Image" style="width:50px; height:50px;">
        </div>
        <div class="info">
          <a href="biodata.php" class="d-block"><?= $_SESSION["username"]?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pinjaman.php" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Pinjaman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Simpanan
              </p>
            </a>
          </li>
        </ul>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simpanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Simpanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Simpanan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control text-muted" id="namaLengkap" value="<?= $anggota["nama_anggota"]?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal Simpan</label>
                    <input type="text" name="tanggal" class="form-control text-muted" id="tanggal" value="<?= $dateNow?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="jumlahSimpanan">Jumlah Simpanan</label>
                    <input type="number" required min="100000" name="jumlahSimpanan" class="form-control" id="jumlahSimpanan" placeholder="Jumlah simpanan">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
                </div>

                  <!-- Modal Konfirmasi -->
                <div class="modal fade" id="konfirmasiPembayaran" tabindex="-1" role="dialog" aria-labelledby="konfirmasiPembayaranTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="konfirmasiPembayaranTitle">Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <div class="card p-2">
                          <p id="nama">Nama : Richado</p>
                          <p id="besar">Jumlah Simpanan : Rp12000.000</p>
                          <p id="bank">Jenis Bank :BRI</p>
                          <p id="rekening">No Rek : 010 642 703 5</p>
                          <p id="tempo">Waktu Tempo :26 Mei 2021</p>
                       </div>
                       <small class="text-muted"> Silahkan lakukan pembayaran pada rekening diatas sampai pada waktu tempo yang telah ditentukan.</small>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary" id="confirmBtn">Konfirmasi</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

     <!-- Modal Bank Transfer -->
     <div class="modal fade" id="pembayaran" tabindex="-1" role="dialog" aria-labelledby="pembayaranTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pembayaranTitle">Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="font-weight-bold">Bank Transfer</p>

            <div class="card">
            <ul class="list-group list-group-flush" id="bankList">
              <li class="list-group-item bank">
                <span class="d-none">Mandiri</span>
                <img src="resources/img/bank-mandiri.svg" alt="">
                <i class="fas fa-chevron-right float-right mt-4"></i>
              </li>
              <li class="list-group-item bank">
                <span class="d-none">BCA</span>
                <img src="resources/img/bank-bca.svg" alt="">
                <i class="fas fa-chevron-right float-right mt-4"></i>
              </li>
              <li class="list-group-item bank">
                <span class="d-none">BNI</span>
                <img src="resources/img/bank-bni.png" alt="">
                <i class="fas fa-chevron-right float-right mt-4"></i>
              </li>
              <li class="list-group-item bank">
                <span class="d-none">Permata</span>
                <img src="resources/img/bank-permata.png" alt="">
                <i class="fas fa-chevron-right float-right mt-4"></i>
              </li>
            </ul>
            </div>
          </div>
        </div>
      </div>
    <!-- /.content -->
  </div>
  
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script>
  // In your Javascript (external .js resource or <script> tag)
let form = $("#quickForm");
form.validate();

$("#btnSimpan").click( () => {
  if(form.valid()){
    $("#pembayaran").modal("show");
  }
});

let bankList = $("#bankList").children();
let bankType;

bankList.each( (index, element) => {
  $(element).click(() => {
    if($("#pembayaran").hasClass("show")){
      
      //Mengambil bank type
      bankType = $(element).find("span").text();
      
      //Tutup modal Pembayaran dan menampilkan modal konfirmasi
      $("#pembayaran").modal("hide");
      $("#konfirmasiPembayaran").modal("show");
    }
  });
})

//Mengisi data konfirmasi pada modal
$("#konfirmasiPembayaran").on("show.bs.modal", () => {
  $("#nama").text("Nama : " + $("#namaLengkap").val());
  $("#besar").text("Jumlah Pinjaman : " + "Rp" + $("#jumlahSimpanan").val());
  $("#bank").text("Bank : " + bankType);
  $("#rekening").text("No Rekening : 09029-2904-8934-9203");
  $("#tempo").text("Tanggal Tempo : " + $("#tanggal").val());
})


</script>

</body>
</html>
