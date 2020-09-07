<?php

require "../functions.php";


$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa
                    WHERE 
                nama LIKE '%$keyword%' OR
                NIM LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";
$mahasiswa = query($query);
?>

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