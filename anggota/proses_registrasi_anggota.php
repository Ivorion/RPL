<?php
require_once "../koneksi.php";

function generate_code($tabel, $inisial){
    global $conn;
	$struktur	= $conn->query("SELECT * FROM $tabel");
	$field		= $struktur->fetch_field_direct(0);
	$panjang	= $field->max_length;
 	$qry	= $conn->query("SELECT MAX(".$field->name.") FROM ".$tabel);
 	$row	= $qry->fetch_array(MYSQLI_NUM); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

if(isset($_POST["submit"])){
    
    $kd_anggota = generate_code("anggota", "P");
    $nama = $_POST["nama"];
    $jk = $_POST["jenisKelamin"];
    $agama = $_POST["agama"];
    $tpt_lahir = $_POST["tempatLahir"];
    $tgl_lahir = $_POST["tanggalLahir"];
    $bulan_lahir = $_POST["bulanLahir"];
    $tahun_lahir = $_POST["tahunLahir"];
    $status_kawin = $_POST["statusKawin"];
    $jenis_pekerjaan = $_POST["jenisPekerjaan"];
    $alamat = $_POST["alamat"];
    $tel = $_POST["noTelepon"];

    echo $jk;
    
    $tanggal_lahir = "" . $tgl_lahir . " " . $bulan_lahir . " " . $tahun_lahir;

    $result = $conn->query("INSERT INTO `anggota` (`kd_anggota`, `nama_anggota`, `jenkel`, `agama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `foto`, `jns_pekerjaan`, `status_kawin`) VALUES ('$kd_anggota', '$nama', '$jk', '$agama', '$tpt_lahir', '$tgl_lahir', '$alamat', '$tel', 'NoPhoto', '$jenis_pekerjaan', '$status_kawin')");

    if($result){
        echo "Data Berhasil ditambahkan";
    }else{
        echo $conn->error;
    }

}
