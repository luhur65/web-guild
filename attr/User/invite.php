<?php 

// Ngecek Url
if (!$_GET['q']) {
    echo showMessage('danger', 'Null Friends', 'Pilih Teman Yg Ingin Diundang');
} elseif (empty($_GET['q'])) {
    echo showMessage('danger', 'Null Friends', 'Pilih Teman Yg Ingin Diundang');
} else {

    // join lewat url / token
    $pengirim = $detail['id_user'];
    $penerima = base64_decode($_GET['q']);
    $idguild = $detail['guild_id'];

    // Data Teman Yg Diundang
    $dataTeman = mysqli_query($conn,"SELECT * FROM guild_info_member WHERE id_user = '$penerima'");
    $teman = mysqli_fetch_assoc($dataTeman);

    // Jika sudah ada guild
    if ($teman['guild_id'] > 0) {
        
        echo showMessage('danger','Gagal',''.$teman['full_name'].' Sudah Memiliki Guild , Tidak Bisa Mengundang Dia');

        return false;
    }
    
    // Data Guild
    $dataGuild = mysqli_query($conn,"SELECT * FROM guild_center WHERE id_guild = '$idguild'");
    $guild = mysqli_fetch_assoc($dataGuild);
    
    $pesan = htmlspecialchars(" Hai , ". $teman['full_name'] ."  Saya Mengundang mu Untuk Bergabung Dengan Guild Saya ". $guild['guild_name'] ." , Saya Tunggu Kamu Di guild Saya Ya !!",ENT_QUOTES);

    $encodePesan = base64_encode($pesan);

    $tglKirim = date("Y-m-d H:i:s a");

    $accept = 0;

    mysqli_query($conn, "INSERT INTO `guild_chat`(`id_invite`, `pengirim`, `pesan_invite`, `to_user`, `date`, `guild_id`, `accept`) VALUES (null,'$pengirim','$encodePesan','$penerima','$tglKirim','$idguild','$accept')");

    $return =  mysqli_affected_rows($conn);

    if ($return > 0) {
        echo alertPopUp('Berhasil Mengirim!! , Permintaan Untuk Join', '?mod=undangTeman');
    } else {
        echo alertPopUp('Gagal Mengundang Teman! , Harap Coba Lagi Nanti!!', '?mod=undangTeman');
    }
}