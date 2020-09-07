<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum

if (isset($_POST["submit"])) {


    //cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('Data Berhasil Ditambahkan!');
            document.location = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan!');
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
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label>
                    NIM :
                    <input type="text" name="NIM" required autocomplete="off">
                </label>
            </li>
            <li>
                <label>
                    Nama :
                    <input type="text" name="Nama" required autocomplete="off">
                </label>
            </li>
            <li>
                <label>
                    Jurusan :
                    <input type="text" name="Jurusan" required autocomplete="off">
                </label>
            </li>
            <li>
                <label>
                    Email :
                    <input type="email" name="Email" required autocomplete="off">
                </label>
            </li>
            <li>
                <label>
                    Gambar :
                    <input type="file" name="Gambar" required autocomplete="off">
                </label>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>

    </form>
</body>

</html>


<!-- <div style=position:absolute;top:0;bottom:0;left:0;right:0;background-color:black;font-size:200px;color:red;text-align:center;>HAHAHAHAHA ANDA TELAH DI HACK</div> -->