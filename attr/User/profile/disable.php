<?php 

if (empty($_GET['user'])) {
    
    echo `<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Null Command!</strong> Check User Yang Ingin Anda Block Akunnya.
    </div>`;

    return false;
} elseif (!isset($_GET['user'])) {

     echo `<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Null Command!</strong> User Tidak Dapat Ditemukan.
    </div>`;

    return false;
} 

$data = $_GET['user'];

// Block 
if (disableAkun($data) > 0) {
    
    echo alertPopUp('Berhasil Memblokir User','?mod=home');
} else {
    echo alertPopUp('Gagal Memblokir User','?mod=home');
}