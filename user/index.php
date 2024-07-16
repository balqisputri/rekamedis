<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php"); 
    exit();
}

    require "../config.php";
    $title = "User - Rekam Medis";

    require "../template/header.php";
    require "../template/navbar.php";
    require "../template/sidebar.php";

    if ($dataUser['jabatan'] !=1 ) {
        echo "<script>
            alert('You Do Not Have Access To This Page');
            window.location = '../index.php';
            </script>";
        exit();
    }
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User Data</h1>
    </div>
    <a href="<?= $main_url ?>user/tambah-user.php" class="btn btn-outline-secondary btn-sm mb-3" title="tambah user baru"><i class="bi bi-plus-lg align-top"></i> New User</a>

    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Picture</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user");
            while ($user = mysqli_fetch_assoc($queryUser)) { 
                $jabatan = $user['jabatan'];
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="col-1"><img src="../asset/gambar/<?= $user['gambar'] ?>" alt="user" class="img-thumbnail rounded-circle img-fluid"></td>
                    <td><?= $user['username']?></td>
                    <td><?= $user['fullname']?></td>
                    <td>
                        <?php
                        if ($jabatan == 1) {
                            echo "Administrator";
                        } else if ($jabatan == 2) {
                            echo "Officer";
                        } else{
                            echo "Doctor";
                        }
                        ?>
                    </td>
                    <td><?= $user['alamat']?></td>
                    <td>
                        <a href="edit-user.php?id=<?= $user ['userid'] ?>&gambar=<?= $user ['gambar'] ?>&aksi=hapus-user" class="btn btn-sm btn-outline-warning" title="edit user"><i class="bi bi-pen align-top"></i></a>
                        <a href="proses-user.php?id=<?= $user ['userid'] ?>&gambar=<?= $user ['gambar'] ?>&aksi=hapus-user" onclick="return confirm ('Are you sure you want to delete this user?')" class="btn btn-sm btn-outline-danger" title="hapus user"><i class="bi bi-trash align-top"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php
    require "../template/footer.php";
?>
