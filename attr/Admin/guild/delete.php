<?php 

if (deleteMyGuild($_POST) > 0) {
    echo alertPopUp('Guild Berhasil Dihapus','?mod=viewGuild');
} else {
    echo showMessage('danger','Gagal','Data Guild Tidak Bisa Dihapus');
}

