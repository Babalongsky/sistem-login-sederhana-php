<?php

session_start();

require 'functions.php';

//cek cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    //ambil username berdasarkan id
    $result = mysqli_query($link, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash("sha256", $row["username"])) {
        $_SESSION["login"] = true;
    }
}

//cek session
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}



if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($link, "SELECT * FROM users WHERE username = '$username'");


    //cek username
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST["remember"])) {
                //buat cookie

                setcookie("id", $row["id"], time() + 60);
                setcookie("key", hash("sha256", $row["username"]), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
    //var_dump($error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chamber.com</title>

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

        header {
            text-align: center;
            color: white;
            height: 40px;
            padding: 10px 0;
            background-color: darkcyan;
            box-shadow: 0 0 2px 3px rgba(0, 0, 0, 0.6);
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-around;

            margin-right: 20px;
            padding: 100px 0;
        }

        .content-satu {
            width: 550px;
            background-image: url(imgcss/login.png);
            background-size: cover;
            background-repeat: no-repeat;
            background-color: darkcyan;
            border-radius: 50% 50% 0 0;
        }


        .content-dua {
            height: 400px;
            width: 300px;
            background-color: darkcyan;
            border-radius: 20px;
            box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);

        }

        .content-dua li {
            list-style: none;
        }

        .content-dua p {
            text-align: center;
            padding: 5px;
        }

        .form {
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        li {
            padding: 5px 0;
            display: flex;
            flex-direction: column;
        }
    </style>

</head>

<body>
    <header>
        <h1>chamber Information System</h1>
    </header>
    <div class="container">
        <div class="content-satu"></div>
        <div class="content-dua">
            <?php if (isset($error)) : ?>
                <p style="color: red; font-style:italic">username/password salah!</p>
            <?php endif; ?>

            <form action="" method="post">

                <ul class="form">
                    <li>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required autocomplete="off">
                    </li>
                    <li>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </li>
                    <li>
                        <input type=checkbox name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </li>
                    <li>
                        <button type="sumbit" name="login">login</button>
                    </li>
                </ul>

            </form>
        </div>
    </div>
    </footer>
</body>

</html>