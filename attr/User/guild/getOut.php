<?php 

// 
if (getOutFromGuild($_POST) > 0) {
    echo alertPopUp('Berhasil Keluar','?mod=profile');
} else {
    echo alertPopUp('Gagal Keluar','?mod=profile');
}

?>
