<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: index.php"); 
    exit();
}

    require "../config.php";
    $title = "Password - Rekam Medis";

    require "../template/header.php";
    require "../template/navbar.php";
    require "../template/sidebar.php";
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Change Password</h1>
    </div>

    <form action="../user/proses-user.php" method="post">
        <div class="form-group mb-3 col-6">
            <label for="oldPass" class="form-label">Old Password</label>
            <input type="password" name="oldPass" class="form-control" id="oldPass" placeholder="Old Password user" autocomplete="off" required>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="newPass" class="form-label">New Password</label>
            <input type="password" name="newPass" class="form-control" id="newPass" placeholder="New password user" autocomplete="off" required>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="confPass" class="form-label">Confirm Password</label>
            <input type="password" name="confPass" class="form-control" id="confPass" placeholder="Enter your new password again" autocomplete="off" required>
        </div>

        <button type="reset" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg align-top"></i> Reset</button>
        <button type="submit" name="ganti-password" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Save</button>

    </form>

</main>

<?php
    require "../template/footer.php";
?>
