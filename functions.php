<?php

//koneksi ke DBMS
$link = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query)
{
    global $link;
    $result = mysqli_query($link, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data)
{
    //ambil data dari tiap elemen dalam form
    global $link;
    $NIM = htmlspecialchars($data["NIM"]);
    $nama = htmlspecialchars($data["Nama"]);
    $jurusan = htmlspecialchars($data["Jurusan"]);
    $email = htmlspecialchars($data["Email"]);

    //jalankan upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO mahasiswa
                VALUES
                ('', '$NIM', '$nama', '$jurusan', '$email', '$gambar' )
                ";

    mysqli_query($link, $query);

    return mysqli_affected_rows($link);
}

//fungsi upload

function upload()
{
    $namaFile = $_FILES['Gambar']['name'];
    $ukuranFile = $_FILES['Gambar']['size'];
    $error = $_FILES['Gambar']['error'];
    $tmpName = $_FILES['Gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png',];
    $ekstensiGambar = explode('.', $namaFile);
    // fungsi delimiter    
    //syamsul.jpg = ['syamsul','jpg']
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('file yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    //lolos pengecekan, gambar siap diupload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}



function hapus($id)
{
    global $link;
    mysqli_query($link, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($link);
}


//ubah

function ubah($data)
{
    //ambil data dari tiap elemen dalam form
    global $link;
    $id = $data["id"];
    $NIM = htmlspecialchars($data["NIM"]);
    $nama = htmlspecialchars($data["Nama"]);
    $jurusan = htmlspecialchars($data["Jurusan"]);
    $email = htmlspecialchars($data["Email"]);
    $gambarlama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES["Gambar"]["error"] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }


    //query insert data
    $query = "UPDATE mahasiswa SET
                NIM = '$NIM',
                Nama = '$nama',
                Jurusan = '$jurusan',
                Email = '$email',
                Gambar = '$gambar'
                WHERE id = $id
                ";

    mysqli_query($link, $query);

    return mysqli_affected_rows($link);
}

// cari
function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa
                    WHERE 
                nama LIKE '%$keyword%' OR
                NIM LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";
    return query($query);
}


//fungsi registrasi

function registrasi($data)
{
    global $link;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($link, $data["password"]);
    $password2 = mysqli_real_escape_string($link, $data["password2"]);


    //cek username sudah ada atau belum

    $result = mysqli_query($link, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah terdaftar')
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai')
        </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //tambahkan user baru ke database
    mysqli_query($link, "INSERT INTO users VALUES('', '$username', '$email', '$password' )");


    return mysqli_affected_rows($link);
}
