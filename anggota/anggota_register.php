<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
</head>
<body>
    <div class="register">
        <h1>Register</h1>
        <form action='' method=''>
            <table cellpadding="8">
            <tr>
                <td>Nama: </td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin: </td>
                <td>
                    <select name="jenisKelamin">
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Agama: </td>
                <td>
                    <select name="agama">
                        <option value="kristen">Kristen</option>
                        <option value="katolik">Katolik</option>
                        <option value="islam">Islam</option>
                        <option value="buddha">Buddha</option>
                        <option value="hindu">Hindu</option>
                        <option value="konghucu">Konghucu</option>
                        <option value="lain-lain">Lain-Lain</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tempat Lahir: </td>
                <td><input type="text" name="tempatLahir"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir: </td>
                <td><input type='date' name="tanggalLahir"></td>
            </tr>
            <tr>
                <td>Alamat: </td>
                <td><input type='text' name="alamat"></td>
            </tr>
            <tr>
                <td>No. Telepon: </td>
                <td><input type='text' name="noTelepon"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type='password' name="password"></td>
            </tr>
            <tr>
                <td>Re-Type Password: </td>
                <td><input type='password' name="rePassword"></td>
            </tr>
            <tr>
                <td>Foto: </td>
                <td><input type='button' name="foto" value='Upload'></td>
            </tr>
            </table>
            <hr>
            <button type='submit'>Daftar</button>
        </form>
    </div>
</body>
</html>