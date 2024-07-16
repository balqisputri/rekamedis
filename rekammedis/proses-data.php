<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

require "../config.php";

// tambah data rekamedis
if (isset($_POST['simpan'])) {
    $no_rm = $_POST['no_rm'];
    $tgl = $_POST['tgl'];
    $idpasien = $_POST['id'];
    $keluhan = trim(htmlspecialchars($_POST['keluhan'])); // Corrected spelling
    $dokter = $_POST['dokter'];
    $diagnosa = trim(htmlspecialchars($_POST['diagnosa']));
    $obat = trim(htmlspecialchars($_POST['obat']));

    mysqli_query($koneksi, "INSERT INTO tbl_rekammedis VALUES ('$no_rm','$tgl', '$idpasien', '$keluhan', $dokter, '$diagnosa', '$obat')");
    header('Location: tambah-data.php?msg=added');
    return;
}

// hapus data
if (@$_GET['aksi'] == 'hapus-data') {
    $id = $_GET['id'];

    mysqli_query($koneksi, "DELETE FROM tbl_rekammedis WHERE no_rm = '$id' ");

    header('location: index.php?msg=deleted');
    return;
}

// update data
if (isset($_POST['update'])) {
    $no_rm = $_POST['no_rm'];
    $tgl = $_POST['tgl'];
    $idpasien = $_POST['id'];
    $keluhan = trim(htmlspecialchars($_POST['keluhan']));
    $dokter = $_POST['dokter'];
    $diagnosa = trim(htmlspecialchars($_POST['diagnosa']));
    $obat = trim(htmlspecialchars($_POST['obat']));

    mysqli_query($koneksi, "UPDATE tbl_rekammedis SET 
                            tgl_rm      = '$tgl',
                            id_pasien   = '$idpasien',
                            keluhan     = '$keluhan',
                            id_dokter   = '$dokter',
                            diagnosa    = '$diagnosa',
                            obat        = '$obat'
                            WHERE no_rm = '$no_rm'
                            ");

    header('location: index.php?msg=updated');
    return;
}
