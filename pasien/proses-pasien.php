<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

require "../config.php";

// tambah pasien baru
if (isset($_POST['simpan'])) {
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $tglLahir   = $_POST['tgl_lahir'];
    $gender     = $_POST['gender'];
    $telpon     = trim(htmlspecialchars($_POST['telpon']));
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $id         = date('ymdhis');

    mysqli_query($koneksi, "INSERT INTO tbl_pasien VALUES ('$id','$nama', '$tglLahir','$gender','$telpon','$alamat')");
    echo "<script>
        alert('New patient successfully registered!'); 
        window.location='tambah-pasien.php';
    </script>"; 
    return;
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus-pasien') {
    $id =$_GET['id'];

        mysqli_query($koneksi, "DELETE FROM tbl_pasien WHERE id = '$id'");
        echo "<script>
            alert('Patient successfully deleted!'); 
            window.location='index.php';
        </script>";
        return;
    }

// update pasien baru
if (isset($_POST['update'])) {
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $tglLahir   = $_POST['tgl_lahir'];
    $gender     = $_POST['gender'];
    $telpon     = trim(htmlspecialchars($_POST['telpon']));
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $id         = trim(htmlspecialchars($_POST['id']));

    mysqli_query($koneksi, "UPDATE tbl_pasien SET
        nama       = '$nama',
        tgl_lahir  = '$tglLahir',
        gender     = '$gender',
        telpon     = '$telpon',
        alamat     = '$alamat'
        WHERE id = '$id'");
    echo "<script>
        alert('Data patient successfully updated!'); 
        window.location='index.php';
    </script>"; 
    return;
}
