<?php 

// Cek Dulu Role Anggota 
if ($row['role'] == 'Anggota') {
    echo "<script>
    document.location.href = '".base_url."/attr/User'
  </script>";
  exit();

  return false;

}


if (deleteMyGuild($_POST) > 0) {
    echo alertPopUp('Guild Berhasil Dihapus','?mod=viewGuild');
} else {
    echo showMessage('danger','Gagal','Data Guild Tidak Bisa Dihapus');
}

