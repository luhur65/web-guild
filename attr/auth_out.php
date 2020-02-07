<?php

session_start();

// Jika Tidak ADa Session
if (!isset($_SESSION['log_'])) { 
    header("Location: login");
    exit;
// Jika Ada Sesion
} elseif (isset($_SESSION['log_'])) {
    unset($_SESSION['log_']);
    session_destroy();

    header("Location: ../");
    exit;
}





?>