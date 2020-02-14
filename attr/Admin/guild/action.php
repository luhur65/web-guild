<?php 

// Jika $_GET['mod'] === blockGuild
if ($_GET['mod'] === 'blockGuild') {
    
    if (empty($_GET['data'])) {
        echo alertPopUp('Guild Belum Dipilih!!', '?mod=viewGuild');
    } elseif (!isset($_GET['data'])) {
        echo alertPopUp('Guild Yg Dipilih Tidak Ada!!', '?,od=viewGuild');
    } else {
        
        if (blockGuild($_POST) > 0) {
            echo alertPopUp('Berhasil Diblokir', '?mod=viewGuild');
        } else {
            echo alertPopUp('Gagal Memblokir guild', '?mod=viewGuild');
        }
    }

    // Jika $_GET['mod'] === activated
} elseif ($_GET['mod'] === 'activated') {
    
    if (empty($_GET['data'])) {
        echo alertPopUp('Guild Belum Dipilih!!', '?mod=viewGuild');
    } elseif (!isset($_GET['data'])) {
        echo alertPopUp('Guild Yg Dipilih Tidak Ada!!', '?,od=viewGuild');
    } else {
        
        if (aktifkan($_POST) > 0) {
            echo alertPopUp('Berhasil Mengaktifkan guild', '?mod=viewGuild');
        } else {
            echo alertPopUp('Gagal Mengaktifkan guild', '?mod=viewGuild');
        }
    }
}

