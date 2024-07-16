<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php"); 
    exit();
}

    require "../config.php";
    
    $title = "Add User - Rekam Medis";

    require "../template/header.php";
    require "../template/navbar.php";
    require "../template/sidebar.php";

    if ($dataUser['jabatan'] != 1) {
        echo "<script>
            alert ('Page Not Found');
            window.location = '../index.php';
        </script>";
    exit();
    }

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">New User</h1>
        <a href="<?= $main_url ?>user" class="text-decoration-none"><i class="bi bi-arrow-left align-top"></i> Back </a>
    </div>

    <form action="proses-user.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4 mb-4 text-center">
                <div class="px-4 mb-4">
                    <img src="<?= $main_url ?>asset/gambar/user.png" alt="user" class="img-thumbnail mb-3 rounded-circle tampil" width="120px">
                    <input type="file" class="form-control form-control-sm" name="gambar" onchange="imgView()" id="gambar">
                    <span class="text-sm">Type File Gambar JPG | PNG | GIF</span><br>
                    <span class="text-sm">width = height</span>
                </div>
                <button type="reset" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg align-top"></i> Reset</button>
                <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Save</button>
            </div>
            <div class="col-lg-8">
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username :</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="enter your username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="fullname" class="form-label">Full Name :</label>
                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="enter your full name" autocomplete="off" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="enter your password" autocomplete="off" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password2" class="form-label">Confirm password :</label>
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="enter your password again" autocomplete="off" required>
                </div>
                <div class="form-group mb-3">
                    <label for="jabatan" class="form-label">Position :</label>
                    <select name="jabatan" id="jabatan" class="form-select" required>
                        <option value="">-- Choose a position --</option>
                        <option value="1">Administrator</option>
                        <option value="2">Officer</option>
                        <option value="3">Doctor</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Address :</label>
                    <textarea name="alamat" id="alamat" cols="" rows="3" class="form-control" placeholder="enter your address"></textarea>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    function imgView() {
        let gambar = document.getElementById('gambar');
        let tampil = document.querySelector('.tampil');

        let fileReader = new FileReader();
        fileReader.readAsDataURL(gambar.files[0]);

        fileReader.addEventListener('load', (e) => {
            tampil.src = e.target.result;
        });
    }
</script>

<?php
    require "../template/footer.php";
?>
