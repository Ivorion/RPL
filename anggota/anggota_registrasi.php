<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="anggota_registrasi.css">
    <title>Registrasi Anggota</title>
</head>
<body>
    <div class="register">
        <h1>Form Registrasi</h1>
        <hr>
        <form action='proses_registrasi_anggota.php' method='POST'>
            <table cellpadding="8">
            <tr>
                <td>Nama Lengkap: </td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin: </td>
                <td><select name="jenisKelamin" id="">
                    <option value=""></option>
                    <option value="pria">Pria</option>
                    <option value="wanita">Wanita</option>
                </select></td>
            </tr>
            <tr>
                <td>Agama: </td>
                <td><select name="agama" id="">
                    <option value=""></option>
                    <option value="kristen">Kristen</option>
                    <option value="katholik">Katholik</option>
                    <option value="islam">Islam</option>
                    <option value="buddha">Buddha</option>
                    <option value="hindu">Hindu</option>
                    <option value="konghucu">Konghucu</option>
                    <option value="lainLain">Lain-Lain</option>
                </select></td>
            </tr>
            <tr>
                <td>Tempat Lahir: </td>
                <td><input type="text" name="tempatLahir"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir: </td>
                    <td>Tanggal</td>
                <td><select name="tanggalLahir" id="">
                    <?php
                        for($i=1;$i<=31;$i++){
                    ?>
                    <option value=""></option>
                    <option value="<?= $i?>"><?= $i?></option>
                    <?php
                        }
                    ?>
                </select></td>
                    <td>Bulan</td>
                <td><select name="bulanLahir" id="">
                    <?php
                        for($j=1;$j<=12;$j++){
                    ?>
                    <option value=""></option>
                    <option value="<?= $j?>"><?= $j?></option>
                    <?php
                        }
                    ?>
                </select></td>
                    <td>Tahun</td>
                <td><select name="tahunLahir" id="">
                    <?php
                        for($k=1950;$k<=2021;$k++){
                    ?>
                    <option value=""></option>
                    <option value="<?= $k?>"><?= $k?></option>
                    <?php
                        }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td>Alamat: </td>
                <td><textarea class='alamat' name="alamat" id="" cols="30" rows="5" ></textarea></td>
            </tr>
            <tr>
                <td>No Telepon: </td>
                <td><input type="text" name="noTelepon"></td>
            </tr>
            <tr>
                <td>Status Kawin: </td>
                <td><select name="statusKawin" id="">
                    <option value=""></option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select></td>
            </tr>
            <tr>
                <td>Jenis Pekerjaan: </td>
                <td><input type="text" name="jenisPekerjaan"></td>
            </tr>
            <tr>
                <td>Foto: </td>
                <td><input class='foto' type="text" name="foto"></td>
                <td><button class='uploadButton'>Upload</button></td>
            </tr>
            </table>
            <hr>
            <button type='submit' name="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
