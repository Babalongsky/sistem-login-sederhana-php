<?php



require 'functions.php';

//kondisi tombol register sudah ditekan
if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo
            "<script>
            alert('user baru berhasil ditambahkan');
            </script>";
    } else {
        echo mysqli_error($link);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <style>
        label {
            display: block;
        }

        li {
            list-style: none;
        }
    </style>
</head>

<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required autocomplete="off">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required autocomplete="off">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password2">Konfirmasi Password</label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <button type="submit" name="register">Register</button>

        </ul>

    </form>
</body>

</html>