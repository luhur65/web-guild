<?php 


if (likePost() > 0) {
    echo alertPopUp('Berhasil Like','?mod=home');
} else {
    echo alertPopUp('Gagal Like','?mod=home');
}


?>