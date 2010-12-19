<?php 

// Cek Dulu Role Anggota 
if ($row['role'] == 'Anggota') {
    echo "<script>
    document.location.href = '".base_url."/attr/User'
  </script>";
  exit();

  return false;

}

if (delreGuild($_POST) > 0) {
    echo alertPopUp('Berhasil Dihapus', '?mod=guildCase');
} else {
    echo alertPopUp('Gagal Dihapus', '?mod=guildCase');
}