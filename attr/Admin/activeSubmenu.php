<?php 

require_once '../../config/config.php';

$id = $_GET['active'];

if (enable($id) > 0) {
    echo alertPopUp('Berhasil Mengaktifkan Submenu',''. base_url .'/attr/Admin/?mod=settingSubMenu');
} 

