<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'koperasi';

$conn = new mysqli($host, $username, $password, $db_name);

function getDataAnggota($kd_anggota){
    global $conn;

    $data = $conn->query("SELECT * FROM anggota WHERE kd_anggota='$kd_anggota'");

    return $data->fetch_assoc();
}

function getDataFromDatabase($query_text){
    global $conn;

    $data = $conn->query($query_text);
    
    return $data->fetch_assoc();
}

function generate_code($tabel, $inisial){
    global $conn;

	$struktur	= $conn->query("SELECT * FROM $tabel");
	$field		= $struktur->fetch_field_direct(0);
	$panjang	= $field->max_length;
 	$qry	= $conn->query("SELECT MAX(".$field->name.") FROM ".$tabel);
 	$row	= $qry->fetch_array(MYSQLI_NUM); 
 	if ($row[0]=="") {
 		$angka=0;
		return $inisial . "0001"; 
	}
	$angka = substr($row[0], strlen($inisial));
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}