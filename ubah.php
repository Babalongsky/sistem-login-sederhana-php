<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'functions.php';

//ambil data di url
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum

if (isset($_POST["submit"])) {

    //cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
        <script>
            alert('Data Berhasil Diubah!');
            document.location = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal Diubah!');
            document.location = 'index.php';
        </script>
        ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Ubah Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["Gambar"]; ?>">
        <ul>
            <li>
                <label>
                    NIM :
                    <input type="text" name="NIM" required value="<?= $mhs["NIM"]; ?>">
                </label>
            </li>
            <li>
                <label>
                    Nama :
                    <input type="text" name="Nama" value="<?= $mhs["Nama"]; ?>">
                </label>
            </li>
            <li>
                <label>
                    Jurusan :
                    <input type="text" name="Jurusan" value="<?= $mhs["Jurusan"]; ?>">
                </label>
            </li>
            <li>
                <label>
                    Email :
                    <input type="email" name="Email" value="<?= $mhs["Email"]; ?>">
                </label>
            </li>
            <li>
                <label for="Gambar">Gambar :</label> <br>
                <img src="img/<?= $mhs['Gambar']; ?>" alt="" width="60"> <br>
                <input type="file" name="Gambar" id="Gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>

    </form>
</body>

</html>


<!-- <div style=position:absolute;top:0;bottom:0;left:0;right:0;background-color:black;font-size:200px;color:red;text-align:center;>HAHAHAHAHA ANDA TELAH DI HACK</div> -->