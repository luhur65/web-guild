<?php 

// Cek Dulu Role Anggota 
if ($row['role'] == 'Anggota') {
    echo "<script>
    document.location.href = '".base_url."/attr/User'
  </script>";
  exit();

  return false;

}

if (deleteReport($_POST) > 0) {
    echo showMessage('success','Berhasil Dihapus','Report Telah Dihapus');
} else {
    echo showMessage('danger','Gagal Dihapus','Report Tidak Bisa Dihapus');
}