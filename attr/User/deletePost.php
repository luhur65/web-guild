
<?php 

// Ambil Data Postingan
$idpostingan = $_GET['data'];

$base = base64_decode($idpostingan);

$dataPostingan = "SELECT * FROM guild_post WHERE id_post = '$base'";
$queryData = mysqli_query($conn, $dataPostingan);

$rowData = mysqli_fetch_assoc($queryData);

// Jika tidak Ada id di url
if (!$_GET['data']) {
    echo alertPopUp('Data Tidak Ditemukan','?mod=home');
} elseif (empty($_GET['data'])) {
    echo alertPopUp('Data Belum Ada','?mod=home');
}

// Jika id tidak sesuai dengan yg ada di databse
if ($base != $rowData['id_post']) {
    echo '<div class="alert alert-danger" role="alert">
      <h4 class="alert-heading display-3"> 404 Not Found </h4>
      <p><a href="'. base_url .'/attr/User/?mod=hapusPostingan&data='.$_GET['data'] .'">'. base_url .'/attr/User/?mod=hapusPostingan&data='.$_GET['data'] .'</a></p>
      <p class="mb-0">Postingan Anda Tidak Dapat Ditemukan..</p>
    </div>';

    return false;

} else {
    
    if (deletePost($_POST) > 0) {
        echo alertPopUp('Berhasil Dihapus','?mod=home');
    } else {
        echo alertPopUp('Gagal Dihapus','?mod=home');
    }
}