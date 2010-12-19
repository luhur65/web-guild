<?php
session_start();

// Jika Tidak ADa Session
if (!isset($_SESSION['log_'])) { 
    // Kembalikan Ke Halaman Login
    echo '<script>document.location.href="login";</script>';
    exit();

    return false;

// Jika Ada Sesion
} elseif (isset($_SESSION['log_'])) {
    logActivity($_SESSION['log_'],"Telah LogOut Dari WebGuild");
    unset($_SESSION['log_']);
    session_destroy();

    header("Location: ../");
    exit;
}

// Log Out log
// Funtion Log-in Activity
function logActivity($session, $text) 
{

    // Buka file
    $file = fopen('log.txt', 'a+');

    // tulisan log
    $log = "".date('l, d M Y')." ### ".date('H : i : s a')." ### ". $session ." ### ". $text ." ### Done\n";

    // Tulis ke dalam file log.txt
    fwrite($file, $log);

    fclose($file);
}



?>