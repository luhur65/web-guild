<?php 

require_once '../../config/config.php';

$id = $_GET['active'];

if (!isset($id)) {
    header('Location: '. base_url .'/attr/Admin/?mod=settingSubMenu');
    exit;
} elseif (empty($id)) {
    header('Location: '. base_url .'/attr/Admin/?mod=settingSubMenu');
    exit;
} elseif(isset($id)) {

    if (enable($_POST) > 0) {
        echo alertPopUp('Berhasil Mengaktifkan Submenu',''. base_url .'/attr/Admin/?mod=settingSubMenu');
    } else {
        echo alertPopUp('Gagal Mengaktifkan Submenu',''. base_url .'/attr/Admin/?mod=settingSubMenu');
    }
}



?>