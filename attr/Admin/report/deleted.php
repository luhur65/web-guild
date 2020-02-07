<?php 


if (deleteReport($_POST) > 0) {
    echo showMessage('success','Berhasil Dihapus','Report Telah Dihapus');
} else {
    echo showMessage('danger','Gagal Dihapus','Report Tidak Bisa Dihapus');
}