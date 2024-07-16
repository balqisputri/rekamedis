<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

require "../config.php";
$title = "Medicine - Rekam Medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if ($dataUser['jabatan'] == 3) {
    echo "<script>
        alert('You Do Not Have Access To This Page');
        window.location = '../index.php';
    </script>";
    exit();
}

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
   $msg = ''; 
}

$alert = "";
if ($msg == "updated") {
    $alert = '<div class="alert alert-success alert-dismissible fade show updated" role="alert">
                <strong><i class="bi bi-bag-check-fill align-top"></i> Edit medicine data successfully</strong>
              </div>';
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Medicine</h1>
    </div>
    <?php
    if($msg !== '') {
        echo $alert;
    }
    ?>
    <a href="<?= $main_url ?>obat/tambah-obat.php" class="btn btn-outline-secondary btn-sm mb-3" title="Add New Patient"><i class="bi bi-plus-lg align-top"></i> New Medicine</a>

    <div class="table-responsive">
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name Medicine</th>
                    <th>Purpose</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $no = 1;
                $queryObat = mysqli_query($koneksi, "SELECT * FROM tbl_obat");
                while ($obat = mysqli_fetch_assoc($queryObat)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $obat['nama'] ?></td>
                        <td><?= $obat['kegunaan'] ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="edit-obat.php?id=<?= $obat['id'] ?>" class="btn btn-sm btn-outline-warning me-1" title="Edit Medicine"><i class="bi bi-pen align-top"></i></a>
                                <a href="proses-obat.php?id=<?= $obat['id'] ?>&aksi=hapus-obat" onclick="return confirm('Are you sure you want to delete this medicine?')" class="btn btn-sm btn-outline-danger" title="hapus obat"><i class="bi bi-trash align-top"></i></a>
                            </div>
                        </td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    window.setTimeout(function(){
        $('.updated').fadeOut();
    }, 5000);
</script>


<?php
require "../template/footer.php";
?>
