<?php 

$id = $_GET['user'];

if(hapusUser($id) > 0) {

    echo 'Berhasil';
} else {
    echo 'Gagal';
}

?>