<?php
  require_once 'libraries/session_check.php';
  require_once 'libraries/database.php';
  require_once 'libraries/utils.php';

  //Session untuk notifikasi
  $status = "";
  
  //Cek notifikasi
  if(isset($_SESSION["status"])){
    $status = $_SESSION["status"];
    unset($_SESSION["status"]);
  }


  //kd_anggota sementara
  $id_anggota = $_SESSION["userid"];
  $anggota = getDataFromDatabase("SELECT kd_anggota, foto FROM anggota WHERE id_anggota = '$id_anggota'");
 
  //Cek apakah user sudah terdaftar sebagai anggota
  $isMember = false;
  if(is_null($anggota)) {
    $kd_anggota = "";
  }else{
    $kd_anggota = $anggota["kd_anggota"];
    $isMember = true;
  }
  
  $result = $conn->query("SELECT * FROM pinjaman_sementara WHERE kd_anggota='$kd_anggota'");
  $simpanan = $conn->query("SELECT * FROM simpanan_sementara WHERE kd_anggota='$kd_anggota'");
  
  //Akan diganti dengan tabel simpanan
  $total_simpanan_result = $conn->query("SELECT SUM(`besar_simpanan`) as total_simpanan FROM simpanan_sementara WHERE kd_anggota='$kd_anggota'");
  $total_simpanan = $total_simpanan_result->fetch_assoc();

  $total_pinjaman_result = $conn->query("SELECT SUM(`besar_pinjaman`) as total_pinjaman FROM pinjaman_sementara WHERE kd_anggota='$kd_anggota'");
  $total_pinjaman = $total_pinjaman_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
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
    <a href="#" class="brand-link">
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
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item nav-member" id="pinjamanMenu">
            <a href="pinjaman.php" class="nav-link" >
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Pinjaman
              </p>
            </a>
          </li>
          <li class="nav-item nav-member">
            <a href="simpanan.php" class="nav-link" id="simpananMenu">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Row Info -->
        <div class="row">
          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= convertToRupiah($total_simpanan["total_simpanan"])?></h3>

                <p>Total Simpanan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= convertToRupiah($total_pinjaman["total_pinjaman"])?></h3>

                <p>Total Pinjaman</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Row Hisory Simpanan -->
        <div class="row">
          <div class="col-lg-12">
          <!-- TABLE: HISTORI SIMPANAN -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Riwayat Simpanan</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>Kode Simpanan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php while($row = $simpanan->fetch_assoc()) { ?>
                  <tr>
                    <td><?= $row["kd_simpanan"]?></td>
                    <td><?= convertToRupiah($row["besar_simpanan"])?></td>
                    <td><span class="badge badge-warning">Belum dibayar</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $row["tgl_simpanan"]?></div>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Riwayat Pinjaman</h3>
      
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                      <tr>
                        <th>Kode Pinjaman</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php while($pinjaman = $result->fetch_assoc()) { ?>
                      <tr>
                        <td><?= $pinjaman["kd_pinjaman"]?> </td>
                        <td><?= convertToRupiah($pinjaman["besar_pinjaman"])?></td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $pinjaman["tgl_pinjaman"]?></div>
                        </td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
          </div>
      </div>
    </section>
  </div>
  <!-- /.content-header -->

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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>


<script>
let status = '<?= $status ?>';
let isMember = '<?= $isMember ?>';


if(status != ""){
  toastr.success(status);
}


if(!isMember) {
  //Cegah untuk masuk ke menu pinjaman dan simpanan jika belum terdaftar sebagai anggota
  $(".nav-member").click( () => {
    showWarningMessage();
  })

  $(".nav-member a").click( (e) => {
    e.preventDefault();
  });
  //Menampilkan pesan peringatan
  

}


function showWarningMessage() {
  Swal.fire({
  title: 'Akses ditolak',
  text: "Anda belum terdaftar sebagai anggota.",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Daftar'
  }).then((result) => {
    if(result.isConfirmed) {
      window.location.href = "biodata.php";
    }
  })
}

</script>
</body>
</html>
