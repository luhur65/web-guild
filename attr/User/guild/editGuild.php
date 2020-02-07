<?php 

$id = base64_decode($_GET['data']);

$dataGuild = "SELECT * FROM guild_center INNER JOIN guild_info_member ON guild_center.creator = guild_info_member.id_user WHERE guild_center.id_guild = '$id'";
$queryData = query($dataGuild);

// Jika Diedit
if (isset($_POST['save'])) {
    
    if (editAllData($_POST) > 0) {
        echo alertPopUp('Guild Berhasil Diubah','?mod=home');
    } else {
        echo alertPopUp('Guild Gagal Diubah','?mod=home');
    }
}

?>

<!-- Judul Halaman -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Guild</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>

<?php foreach($queryData as $q) : ?>
<div class="card p-2 shadow rounded">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <img src="<?= base_url; ?>/assets/img/guild_img/<?= $q['guild_img']; ?>" alt="guild img"
                    class="img-fluid py-5">
            </div>
            <div class="col-lg mt-3">
                <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="bannerLama" value="<?= $q['guild_img']; ?>" readonly>
                    <div class="form-group">
                        <label for="nama">Guild Name</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $q['guild_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="info">Info Guild</label>
                        <textarea class="form-control" name="info" id="info"
                            rows="5"><?= $q['guild_info']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="share">Akses Guild</label>
                        <select class="custom-select" name="share" id="share">
                            <option value="<?= $q['guild_post']; ?>" selected><?= $q['guild_post']; ?></option>
                            <option value="Public">Public Guild</option>
                            <option value="Private">Private Guild</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="user">Creator</label>
                      <input type="text" name="user" id="user" class="form-control" value="<?= $q['full_name']; ?>" readonly >
                    </div>
                    <div class="form-group">
                        <div class="custom-file mt-2">
                            <input type="file" name="gambar" class="custom-file-input" id="gambar">
                            <label for="gambar" class="custom-file-label">Pilih Banner / Foto Guild</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right" name="save">Save Changes</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php endforeach; ?>