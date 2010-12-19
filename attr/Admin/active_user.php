<?php 

// Cek Dulu Role Anggota 
if ($row['role'] == 'Anggota') {
    echo "<script>
    document.location.href = '".base_url."/attr/User'
  </script>";
  exit();

  return false;

}

if (empty($_GET['user'])) {
    
    echo `<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Null Command!</strong> Check User Yang Ingin Anda Block Akunnya.
    </div>`;
} elseif (!isset($_GET['user'])) {

     echo `<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Null Command!</strong> User Tidak Dapat Ditemukan.
    </div>`;
} else {

    // Activated
    if (openAccessuser($_POST) > 0) {
        
        echo alertPopUp('Berhasil Mengaktifkan Kembali Akun User','?mod=home');
    } else {

        echo alertPopUp('Gagal Mengaktifkan Kembali Akun User','?mod=home');
    }
}

?>