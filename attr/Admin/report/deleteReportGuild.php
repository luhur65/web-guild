
<?php 

if (delreGuild($_POST) > 0) {
    echo alertPopUp('Berhasil Dihapus', '?mod=guildCase');
} else {
    echo alertPopUp('Gagal Dihapus', '?mod=guildCase');
}