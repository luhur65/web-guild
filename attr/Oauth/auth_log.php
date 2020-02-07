<?php

session_start();

if (isset($_POST['log_'])) {
    if (empty($_POST['username'] || $_POST['password'])) {
        
        $login_kosong = true;

        return false;
    }

    $username = $_POST['username'];
    $email = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM guild_info_member WHERE guild_info_member.username = '$username'");

    $loginWithEmail = mysqli_query($conn, "SELECT * FROM guild_info_member WHERE guild_info_member.email = '$email'");

// Jika Login Dengan Username
    if (mysqli_num_rows($query) === 1) {
        // cek passwordnya
        $row = mysqli_fetch_assoc($query);
        // Cek Apakah Akun aktif Atau belum ?
        if ($row['is_aktif'] < "1") {
            $cekRole = true;

            return false;
        }
        if (password_verify($password, $row['password'])) {
            $_SESSION['log_'] = $username;
            // cek role akun
            if ($row['role'] == "1") {
                $_SESSION['log_'] = $username;

                header("Location: ". base_url ."/attr/Admin");
                exit;
            } else {
                ($row['role'] == "2");
                $_SESSION['log_'] = $username;

                header("Location:  ". base_url ."/attr/User");
                exit;
            }
        }
    } 

    $error = true;
    echo mysqli_error($conn);


    // Jika Login Dengan Username
    if (mysqli_num_rows($loginWithEmail) === 1) {
        // cek passwordnya
        $akunEmail = mysqli_fetch_assoc($loginWithEmail);
        // Cek Apakah Akun aktif Atau belum ?
        if ($akunEmail['is_aktif'] < "1") {
            $cekRole = true;

            return false;
        }
        if (password_verify($password, $akunEmail['password'])) {
            $_SESSION['log_'] = $username;
            // cek role akun
            if ($akunEmail['role'] == "1") {
                $_SESSION['log_'] = $username;

                header("Location: ". base_url ."/attr/Admin");
                exit;
            } else {
                ($akunEmail['role'] == "2");
                $_SESSION['log_'] = $username;

                header("Location:  ". base_url ."/attr/User");
                exit;
            }
        }
    } 

    $error = true;
    echo mysqli_error($conn);
}