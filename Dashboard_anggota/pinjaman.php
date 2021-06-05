<?php
  require_once 'libraries/session_check.php';
  require_once 'libraries/database.php';
  
  $dateNow = date("F j, Y");

  // Mengambil data anggota
  $anggota = getDataFromAnggotaById($_SESSION["userid"]);
  
  //Cek jika belum terdaftar sebagai anggota
  if(is_null($anggota)){
    header("Location: index.php");
  }

  //Proses data
  if(isset($_POST["submit"])){

    $kd_pinjaman = generate_code("pinjaman_sementara", "S");
    $kd_anggota = $anggota['kd_anggota'];
    $besar_pinjaman = $_POST["jumlahPinjaman"];
    $lama_pinjaman = $_POST["lamaPinjaman"];
    $angsuran_pokok = $_POST["angsuranPokok"];
    $angsuran_bunga = $_POST["angsuranBunga"];
    $date = date("Y-m-d");


    $result = $conn->query("INSERT INTO `pinjaman_sementara` (`kd_pinjaman`, `tgl_pinjaman`, `kd_anggota`, `lama_pinjaman`, `besar_pinjaman`, `angsuran_pokok`, `angsuran_bunga`) VALUES ('$kd_pinjaman', '$date', '$kd_anggota', '$lama_pinjaman', '$besar_pinjaman', '$angsuran_pokok', '$angsuran_bunga');");

    if($result){
      $_SESSION["status"] = "Berhasil mengajukan pinjaman";

      header("location: index.php");
    }

  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pinjaman</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
    <a href="index3.html" class="brand-link">
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
            <a href="pinjaman.html" class="nav-link active">
                <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Pinjaman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="simpanan.php" class="nav-link">
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
            <h1>Pinjaman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Pinjaman</li>
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
                <h3 class="card-title">Form Pinjaman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action=''>
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control text-muted" id="namaLengkap" value="<?= $anggota['nama_anggota'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal Pinjam</label>
                    <input type="text" name="tanggal" class="form-control text-muted" id="tanggal" value="<?= $dateNow?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="jumlahSimpanan">Jumlah Pinjaman</label>
                    <input type="number" min="100000" required name="jumlahPinjaman" class="form-control" id="jumlahPinjaman" placeholder="Jumlah pinjaman">
                  </div>
                  <div class="form-group">
                    <label>Lama Pinjaman</label>
                    <select class="form-control select2" style="width: 100%;" name="lamaPinjaman" id="lamaPinjaman">
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Angsuran Pokok</label>
                    <input type="text" name="angsuranPokok" class="form-control text-muted" id="angsuranPokok" value="0" readonly>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Angsuran Bunga</label>
                    <input type="text" name="angsuranBunga" class="form-control text-muted" id="angsuranBunga" value="0" readonly>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-primary" name="" id="ajukanPinjaman">Ajukan Pinjaman</button>
                </div>

                  <!-- Konfirmasi Modal -->
                <div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="konfirmasiTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="konfirmasiTitle">Konfirmasi Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <section>
                          <p id="cfNama">Nama : </p>
                          <p id="cfJumlah">Jumlah Pinjaman : </p>
                          <p id="cfLama">Lama Pinjaman : </p> 
                          <p id="cfAngsuranPokok">Angsuran Pokok : </p> 
                          <p id="cfAngsuranBunga">Angsuran Bunga : </p> 
                        </section>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary" id="confirmBtn">Konfirmasi</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>


<script>
// In your Javascript (external .js resource or <script> tag)
let form = $("#quickForm");
form.validate();

$("#ajukanPinjaman").click( () => {
  if(form.valid()){

    //Ambil data dari form dan masukkan ke modal
    $("#cfNama").text("Nama Lengkap : " + $("#namaLengkap").val());
    $("#cfJumlah").text("Jumlah Pinjaman : " + $("#jumlahPinjaman").val());
    $("#cfLama").text("Lama Pinjaman : " + $("#lamaPinjaman :selected").text());
    $("#cfAngsuranPokok").text("Angsuran Pokok : " + $("#angsuranPokok").val());
    $("#cfAngsuranBunga").text("Angsuran Bunga : " + $("#angsuranBunga").val());


    $("#konfirmasi").modal("show");
  }
});



//ambil reference element html
const ePinjaman = document.getElementById("jumlahPinjaman");
const eLamaPinjam = document.getElementById("lamaPinjaman");
const eAngsuranPokok = document.getElementById("angsuranPokok");
const eAngsuranBunga = document.getElementById("angsuranBunga");

let besarPinjaman = 0;
let angsuranPokok = 0;
let angsuranBunga = 0;
let selectedBulan = 1;

let bulan = 0;

// Mengambil besar pinjaman
ePinjaman.addEventListener('input', function(e) {
  besarPinjaman = e.target.value;

  if(besarPinjaman >= 1e8) bulan = 60;
  else if(besarPinjaman >= 5e7) bulan = 36;
  else if(besarPinjaman >= 15e6) bulan = 24;
  else if(besarPinjaman >= 5e6) bulan = 9;
  else if(besarPinjaman >= 2e6) bulan = 7;
  else if(besarPinjaman >= 1e6) bulan = 5;
  else if(besarPinjaman >= 1e5) bulan = 3;


});

//Event ketika selesai menginput besar pinjaman
ePinjaman.addEventListener('blur', function(e) {
  
  let monthOption = bulan;
  let yearOption = 0;

  if(bulan >= 12){
    monthOption = 11;
    yearOption = bulan / 12;
  }

  removeChildOption();

  //Menambahkan option bulan
  for (let i = 1; i <= monthOption; i++) {
    addOptionIntoSelect('Bulan', i);
  }

  //Menambahkan option tahun
  for (let i = 1; i <= yearOption; i++) {
    addOptionIntoSelect('Tahun', i);
  }

  setAngsuran();
});

//Menampilkan angsuran
$(document).ready(function() {
    $('.select2').select2();
    $('.select2').change( (e) => {
      selectedBulan = parseInt(e.target.value);
      setAngsuran();
    })
});

//Functions
function addOptionIntoSelect(optionText, bulan) {
    let value = bulan + " " +  optionText;

    const opt = document.createElement('option');
    opt.appendChild(document.createTextNode(value))

    if(optionText == "Tahun") {
      bulan  *= 12; 
    }

    opt.value = bulan;
    eLamaPinjam.appendChild(opt);
}

function removeChildOption() {
  while(eLamaPinjam.firstChild){
    eLamaPinjam.removeChild(eLamaPinjam.lastChild);
  }
}

function setAngsuran() {
  angsuranPokok = Math.ceil(besarPinjaman / selectedBulan);
  angsuranBunga = Math.ceil(angsuranPokok * 0.02);

  eAngsuranPokok.value = angsuranPokok;
  eAngsuranBunga.value = angsuranBunga;
}




</script>
</body>
</html>
