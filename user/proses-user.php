<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php"); 
    exit();
}

require "../config.php";

if (isset($_POST['simpan'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $nama = trim(htmlspecialchars($_POST['fullname']));
    $jabatan = $_POST['jabatan'];
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $gambar = htmlspecialchars($_FILES['gambar']['name']);
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername)) {
        echo "<script>alert('Username already exists! New user failed to register'); window.location='tambah-user.php';</script>";
        return;
    }

    if ($password !== $password2) {
        echo "<script>alert('Confirm password is incorrect, new user registration failed!'); window.location='tambah-user.php';</script>";
        return;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    if ($gambar != null) {
        $url = 'tambah-user.php';
        $gambar = uploadGbr($url);
    } else {
        $gambar = 'user.png';
    }

    $query =  "INSERT INTO tbl_user (username, fullname, password, jabatan, alamat, gambar) VALUES ('$username', '$nama', '$pass', '$jabatan', '$alamat', '$gambar')";
    mysqli_query($koneksi, $query);

    echo "<script>alert('New user has successfully registered!'); window.location='tambah-user.php';</script>";
    return;
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus-user') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $gbr = isset($_GET['gambar']) ? $_GET['gambar'] : null;

    if ($id && $gbr) {
        mysqli_query($koneksi, "DELETE FROM tbl_user WHERE userid = $id");
        if ($gbr != 'user.png') {
            unlink('../asset/gambar/' . $gbr);
        }
        echo "<script>alert('User successfully deleted!'); window.location='index.php';</script>";
    }
    return;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $usernameLama = trim(htmlspecialchars($_POST['usernameLama']));
    $username = trim(htmlspecialchars($_POST['username']));
    $nama = trim(htmlspecialchars($_POST['fullname']));
    $jabatan = $_POST['jabatan'];
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $gambar = htmlspecialchars($_FILES['gambar']['name']);
    $gbrLama = htmlspecialchars($_POST['gbrLama']);

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if($username !== $usernameLama) {
        if (mysqli_num_rows($cekUsername)) {
            echo "<script>alert('Username already exists!, user failed to update'); window.location='tambah-user.php';</script>";
            return;
        }
    }

    if ($gambar != null) {
        $url = 'index.php';
        $gambar = uploadGbr($url);
        if($gbrLama !== 'user.png') {
            @unlink('../asset/gambar/'. $gbrLama);
        }
     } else {
        $gambar = $gbrLama;
    }

    mysqli_query($koneksi, "UPDATE tbl_user SET 
        username = '$username',
        fullname = '$nama',
        jabatan = '$jabatan',
        alamat = '$alamat',
        gambar = '$gambar'
        WHERE userid = $id 
    ");

    echo "<script>alert(' User data updated successfully!'); window.location='index.php';</script>";
    return;
}

//ganti password
if(isset($_POST['ganti-password'])) {
    $curPass   = trim(htmlspecialchars($_POST['oldPass']));
    $newPass   = trim(htmlspecialchars($_POST['newPass']));
    $confPass  = trim(htmlspecialchars($_POST['confPass']));

    $userLogin = $_SESSION['ssUserRM'];
    $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$userLogin'");
    $dataUser = mysqli_fetch_assoc($queryUser);

    if($newPass != $confPass) {
        echo "<script>
            alert('Password failed to update, confirm password is not the same'); 
            window.location='../otentikasi/password.php';
        </script>";
        return false;
    }

    if(!password_verify($curPass, $dataUser['password'])) {
        echo "<script>
            alert('Password failed to update, old password does not match'); 
            window.location='../otentikasi/password.php';
        </script>";
        return false;
    } else {
        $pass =  password_hash($newPass, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass' WHERE username = '$userLogin'");
        echo "<script>
            alert('Password changed successfully'); 
            window.location='../otentikasi/password.php';
        </script>";
        return true;
    }
}

?>
