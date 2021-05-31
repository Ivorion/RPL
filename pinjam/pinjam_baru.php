<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="simpanan.css">
    <title>Buat Pinjaman Baru</title>
</head>
<body>
    <h1>Buat Pinjaman Baru</h1>
    <hr>
    <form action="">
        <table>
            <tr>
                <td>Nama: </td>
                <td><input type="text" name='nama'></td>
            </tr>
            <tr>
                <td>No Pinjaman: </td>
                <td><input type="text" name='noSimpanan'></td>
            </tr>
            <tr>
                <td>Tgl Pinjaman: </td>
                <td><input type="text" name='tglSimpanan'></td>
            </tr>
            <tr>
                <td>Jenis Pinjaman</td>
                <td><select name="jenisPinjaman" id="">
                    <option value="" name='harian'>Harian</option>
                    <option value="" name='bulanan'>Bulanan</option>
                </select></td>
            </tr>
            <tr>
                <td>Besar Pinjaman: </td>
                <td><input type="text" name='besarPinjaman'></td>
            </tr>
            <tr>
                <td>Lama Pinjaman: </td>
                <td><input type="text" name='lamaPinjaman'></td>
            </tr>
            <tr>
                <td>Angsuran Pokok: </td>
                <td><input type="text" name='angsuranPokok'></td>
            </tr>
            <tr>
                <td>Angsuran Bunga: </td>
                <td><input type="text" name='angsuranBunga'></td>
            </tr>
        </table>
        <hr>
        <button name='ajukanPinjaman'>Ajukan Pinjaman</button>
    </form>
</body>
</html>