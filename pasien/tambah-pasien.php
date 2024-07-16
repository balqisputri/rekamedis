<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php"); 
    exit();
}

    require "../config.php";
    
    $title = "Add Patient - Rekam Medis";

    require "../template/header.php";
    require "../template/navbar.php";
    require "../template/sidebar.php";

    if ($dataUser['jabatan'] == 3) {
        echo "<script>
            alert ('Page Not Found');
            window.location = '../index.php';
        </script>";
        exit(); 
    }
    ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">New Patient</h1>
        <a href="<?= $main_url ?>pasien" class="text-decoration-none"><i class="bi bi-arrow-left align-top"></i> Back </a>
    </div>

    <form action="proses-pasien.php" method="post">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Name</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Name Patient" require>
                </div>
                <div class="form-group mb-3">
                    <label for="tgl_lahir" class="form-label">Date</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
                </div>
                <div class="form-group mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <div>
                    <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="P" require>
                <label class="form-check-label" for="flexRadioDefault1">
                    Male
                </label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="W">
                <label class="form-check-label" for="flexRadioDefault2">
                    Female
                </label>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="telpon" class="form-label">Telephone / HP </label>
            <input type="tel" name="telpon" id="telpon" class="form-control" pattern="[0-9]{8,}" title="minimal 8 angka" required>
        </div>
        <div class="form-group mb-3">
            <label for="alamat" class="form-label">Address </label>
            <textarea name="alamat" id="alamat" cols="" rows="" class="form-control" placeholder="Address Patient" required></textarea>
        </div>
        <button type="reset" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg align-top"></i> Reset</button>
        <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Save</button>
    </div>
    </div>
    </form>

</main>



<?php
    require "../template/footer.php";
?>
