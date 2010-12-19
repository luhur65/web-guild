<?php 

require_once '../../config/config.php';

// Cek Dulu Role Anggota 
if ($row['role'] == 'Anggota') {
    echo "<script>
    document.location.href = '".base_url."/attr/User'
  </script>";
    exit();

    return false;
}

$id = $_GET['block'];

if (!isset($id)) {
    header('Location: ?mod=settingSubMenu');
    exit;
} elseif (empty($id)) {
    header('Location: ?mod=settingSubMenu');
    exit;
} elseif(isset($id)) {

    if (disabled($_POST) > 0) {
        echo alertPopUp('Berhasil Menonaktifkan Submenu',''. base_url .'/attr/Admin/?mod=settingSubMenu');
    } else {
        echo alertPopUp('Gagal Menonaktifkan Submenu',''. base_url .'/attr/Admin/?mod=settingSubMenu');
    }
}



?>