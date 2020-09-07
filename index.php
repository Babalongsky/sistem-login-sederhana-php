<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");


//tombol cari ditekan
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chamber</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            background-image: url("imgcss/herringbone.png");
            background-size: cover;
            background-repeat: repeat-y;
            max-height: 900px;
        }

        .loader {
            width: 100px;
            position: absolute;
            top: 60px;
            z-index: -1;
            margin-left: -30px;
            display: none;

        }

        header {
            display: flex;
            justify-content: space-evenly;
            text-align: center;
            color: white;
            height: 40px;
            padding: 10px 0;
            background-color: darkcyan;
            box-shadow: 0 0 2px 3px rgba(0, 0, 0, 0.6);
        }

        .cari {
            display: flex;
            flex-direction: row;
            justify-content: center;
            padding: 20px 0;
        }

        #table {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            table-layout: auto;
            text-align: center;
        }

        #table .tambah {
            align-items: right;
            margin-right: -600px;
            padding: 10px;
        }

        header a {
            color: red;

        }

        footer {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Daftar Mahasiswa</h1>
            <a href="logout.php">Logout</a>
        </header>
        <div class="cari">
            <form action="" method="post">
                <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian" autocomplete="off" id="keyword">
                <button type="submit" name="cari" id="tombol-cari">Cari</button>

                <img src="img/loader1.gif" alt="" class="loader">
            </form>
        </div>

        <div id="table">

            <table border="1" cellpadding="10" cellspacing="0">

                <tr>
                    <th>No.</th>
                    <th>Aksi</th>
                    <th>Gambar</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($mahasiswa as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda Yakin?');">Hapus</a>
                        </td>
                        <td><img src="img/<?= $row["Gambar"]; ?>" width="50" alt=""></td>
                        <td><?= $row["NIM"]; ?></td>
                        <td><?= $row["Nama"]; ?></td>
                        <td><?= $row["Jurusan"]; ?></td>
                        <td><?= $row["Email"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>

            </table>
            <a href="tambah.php" class="tambah">Tambah Data Mahasiswa</a>
        </div>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>