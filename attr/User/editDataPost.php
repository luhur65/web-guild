<?php

// Ambil data encoding di url
$encode = $_GET['data'];

// decode data
$id = base64_decode($_GET['data']);

// cek jika yg mengakses halaman ini bukan pemilik akun yg sebenarnya 
if($detail['id_user'] !== $id){
    echo "<script> document.location.href='?mod=home'; </script>";

    exit();
    return false;
}

// Pengecekan url
if (!$id) {
    echo '<div class="alert alert-danger" role="alert">
      <h4 class="alert-heading display-4">404 Not Found</h4>
      <p classs="font-italic">Periksa Kembali..</p>
      <p class="mb-0">Postingan Anda Tidak Dapat Ditemukan</p>
    </div>';

    return false;
} elseif (empty($id)) {
    echo '<div class="alert alert-danger" role="alert">
      <h4 class="alert-heading display-4">404 Not Found</h4>
      <p classs="font-italic">Periksa Kembali..</p>
      <p class="mb-0">Postingan Anda Kosong</p>
    </div>';

    return false;
}

// Data Postingan
$data = "SELECT * FROM guild_post JOIN guild_info_member ON guild_post.user_id = guild_info_member.id_user WHERE id_post = '$id' and username = '$guild_session'";

$queryData = mysqli_query($conn,$data);

$rowData = mysqli_fetch_assoc($queryData);


// Jika Di Tekan Tombol save changes
if (isset($_POST['edit'])) {
    if (editPost($_POST) > 0) {
        echo alertPopUp('Berhasil Di Edit','?mod=home');
    } else {
        echo alertPopUp('Gagal Di edit','?mod=home');
        // echo mysqli_error($conn);
    }
}

?>

<div class="card shadow p-3 mx-auto rounded">
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="post">
                    <img src="<?= base_url; ?>/assets/img/user-icon/<?= $rowData['foto_profil']; ?>"
                        class="img-fluid img-anggota rounded-circle" alt="Profile">
                    <?= $rowData['full_name'] ?>
                </label>
                <textarea class="form-control" name="post" id="post" rows="6"
                    required><?= htmlspecialchars($rowData['post']); ?></textarea>
            </div>
            <div class="form-group row">
                <div class="col-lg-5">
                    <button type="submit" name="edit" class="btn btn-success btn-block">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>