<?php

session_start();
require "../config.php"; // Ubah path ke file config.php

if (isset($_POST['login'])) {
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    $cekUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    if (mysqli_num_rows($cekUser) === 1) {
        $row = mysqli_fetch_assoc($cekUser);
        if (password_verify($password, $row['password'])) {
            // set session //
            $_SESSION['ssLoginRM'] = true;
            $_SESSION['ssUserRM'] = $username;
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>
                alert('Password wrong!'); 
                document.location.href = 'index.php';
            </script>";
        }
    } else {
        echo "<script>
                alert('Login failed!'); 
                document.location.href = 'index.php';
            </script>";
    }
}

?>
