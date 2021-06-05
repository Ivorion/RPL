<?php
    require_once 'libraries/session_check.php';
    require_once 'libraries/database.php';


    $message = '';
    //Check session
    if(isset($_SESSION['status'])){
      $message = $_SESSION["status"];

      unset($_SESSION["status"]);
    } 

    $id_anggota = $_SESSION["userid"];
    $edit = false;
    //Check apakah sudah ada didatabase
    $result_anggota = $conn->query("SELECT * FROM anggota WHERE id_anggota='$id_anggota'");
    $anggota = $result_anggota->fetch_assoc();

    if($result_anggota->num_rows) {
        $edit = true;
    }
    
    //Check jika tombol submit ditekan
    if(isset($_POST["submit"])) {
        $kd_anggota = generate_code("anggota", "P");
        $nama = $_POST["nama"];
        $jk = $_POST["jenisKelamin"];
        $agama = $_POST["agama"];
        $tpt_lahir = $_POST["tempatLahir"];
        $status_kawin = $_POST["statusKawin"];
        $jenis_pekerjaan = $_POST["jenisPekerjaan"];
        $alamat = $_POST["alamat"];
        $tel = $_POST["noTelepon"];
        $tgl_lahir = $_POST["tanggalLahir"];

        //Upload Foto
        $folder_location = "./resources/assets/uploads";
        $file_foto = (object) @$_FILES['foto'];
        $name_foto = $file_foto->name;

        if(!file_exists("{$folder_location}/{$name_foto}")) {
            $foto_uploaded = move_uploaded_file($file_foto->tmp_name, "{$folder_location}/{$name_foto}");
        }
        

        //Cek apakah tombol ditekan untuk menambah data atau mengedit data
        if($edit) {
            //Mengedit data
            if($name_foto == ""){
              $name_foto = $anggota["foto"];
            }
            $kd_anggota = $anggota["kd_anggota"];
            $result = $conn->query("UPDATE `anggota` SET `nama_anggota` = '$nama', `jenkel` = '$jk', `agama` = '$agama', `tempat_lahir` = '$tpt_lahir', `tgl_lahir` = '$tgl_lahir', `alamat` = '$alamat', `no_telp` = '$tel', `foto` = '$name_foto', `jns_pekerjaan` = '$jenis_pekerjaan', `status_kawin` = '$status_kawin' WHERE `anggota`.`kd_anggota` = '$kd_anggota';");
            $_SESSION["status"] = "Data berhasil diubah";


        }else{
            //Menambah data baru
            $result = $conn->query("INSERT INTO `anggota` (`kd_anggota`, `nama_anggota`, `jenkel`, `agama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `foto`, `jns_pekerjaan`, `status_kawin`, `id_anggota`) VALUES ('$kd_anggota', '$nama', '$jk', '$agama', '$tpt_lahir', '$tgl_lahir', '$alamat', '$tel', '$name_foto', '$jenis_pekerjaan', '$status_kawin', '$id_anggota')");
            $_SESSION["status"] = "Data berhasil disimpan";
        }

        //Refresh page
        header("Location: biodata.php");
        
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biodata</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="resources/css/custom.css">


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
      <img src="resources/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
          <a href="" class="d-block">Ric</a>
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
            <h1>Biodata</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Biodata</li>
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
                <h3 class="card-title">Form Biodata</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action='' enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="namaLengkap" value="<?= ($edit) ? $anggota["nama_anggota"] : "" ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control select2" style="width: 100%;" name="jenisKelamin" id="jenisKelamin" >
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control select2" style="width: 100%;" name="agama" id="agama">
                        <option value="kristen">Kristen</option>
                        <option value="katholik">Katholik</option>
                        <option value="islam">Islam</option>
                        <option value="buddha">Buddha</option>
                        <option value="hindu">Hindu</option>
                        <option value="konghucu">Konghucu</option>
                        <option value="lainLain">Lain-Lain</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jumlahSimpanan">Tempat Lahir</label>
                    <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" required value="<?= ($edit) ? $anggota["tempat_lahir"] : "" ?>">
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal Lahir</label>
                    <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" required value="<?= ($edit) ? $anggota["tgl_lahir"] : "" ?>">
                  </div>
                  <div class="form-group">
                    <label for="jumlahSimpanan">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" required value="<?= ($edit) ? $anggota["alamat"] : "" ?>">
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">No Telepon</label>
                    <input type="number" name="noTelepon" class="form-control" id="noTelepon" required value="<?= ($edit) ? $anggota["no_telp"] : "" ?>">
                  </div>
                  <div class="form-group">
                    <label>Status Menikah</label>
                    <select class="form-control select2" style="width: 100%;" name="statusKawin" id="statusKawin">
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jumlahSimpanan">Jenis Pekerjaan</label>
                    <input type="text" name="jenisPekerjaan" class="form-control" id="jenisPekerjaan" required value="<?= ($edit) ? $anggota["jns_pekerjaan"] : "" ?>">
                  </div>
                  <div class="form-group">
                    <label for="foto">Foto</label><br>
                    <img src="resources/assets/uploads/<?= ($edit) ? $anggota["foto"] : "" ?>" alt="" id="img-prev" class="d-none"><br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" required name="foto">
                        <label class="custom-file-label" for="foto">Choose file...</label>
                    </div>
                 </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                </div>
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
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>


<script>
//Check jika mengedit data
let edit = '<?= $edit ?>';

if(edit != "") {

    $("#img-prev").removeClass("d-none");

    let selectedJK = '<?= (is_null($anggota)) ? "" : $anggota["jenkel"] ?>';
    let selectedStatus = '<?= (is_null($anggota)) ? "" : $anggota["status_kawin"] ?>';
    let selectedAgama = '<?= (is_null($anggota)) ? "" : $anggota["agama"] ?>';
    
    // Setting selected option
    $("#jenisKelamin").val(selectedJK);
    $("#statusKawin").val(selectedStatus);
    $("#agama").val(selectedAgama);

    $("#submit").text("Simpan");
    $("#foto").removeAttr("required");
}

//Cek jika mengupload file
$("#foto").change( (e) => {
  $("#img-prev").removeClass("d-none");
  let file = e.currentTarget.files[0];
  if(file){
    let reader = new FileReader();

    reader.onload = (e) => {
      $("#img-prev").attr("src", e.target.result);
      console.log(e);
    };

    reader.readAsDataURL(file);
  }
});

//Menampilkan pesan berhasil
let message = "<?= $message?>";
if(message != "") {
  Swal.fire(
  'Berhasil',
  message,
  'success'
)
}

</script>
</body>
</html>
