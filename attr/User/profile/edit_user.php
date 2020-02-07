<?php

if (isset($_POST['submit'])) {

    if (editProfil($_POST) > 0) {
      $success = true; 
    } else {
      $gagal = true; 
      echo mysqli_error($conn);
    }
}


?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="divider-header">
<div class="card shadow p-4 rounded text-dark mb-5">
  <?php if(isset($success)) : ?>
  <?= showMessage('success','Berhasil','Profil Anda Telah Diperbaharui'); ?>
  <script>
  document.location.href = '?mod=profile';
  </script>
<?php elseif(isset($gagal)): ?>
<?= showMessage('danger','Gagal','Something Wrong Happen , Sorry !'); ?>
<?php endif ?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $detail['id_user']; ?>" readonly>
<input type="hidden" name="gambarLama" value="<?= $detail['foto_profil']; ?>">
    <div class="form-group">
      <label for="namaLengkap">Nama Lengkap</label>
      <input type="text" name="full_name" id="namaLengkap" class="form-control" value='<?= $detail['full_name'] ?>' aria-describedby="helpId" required>
      <small id="helpId" class="text-muted"></small>
    </div>
    <div class="form-group">
      <label for="email">Email Anda</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" value="<?= $detail['email'] ?>" readonly>
      <small id="emailHelpId" class="form-text badge badge-info">Tidak Bisa Mengubah Email</small>
    </div>
    <div class="form-group">
      <label for="bio">Biografi</label>
      <textarea class="form-control" name="bio" id="bio" rows="3" required><?= $detail['biografi']; ?>
      </textarea>
    </div>
    <div class="form-group mb-3 mt-4">
    <?php if($detail['foto_profil'] > 0): ?>
    <p class="text-dark">Ganti Profil</p>
    <img width="120" src="<?= base_url; ?>/assets/img/user-icon/<?= $detail['foto_profil'] ?>" class="img-fluid img-profile rounded mb-3">
    <?php endif ?>
	<div class="custom-file mt-2">
		<input type="file" name="gambar" class="custom-file-input" id="gambar">
		<label for="gambar" class="custom-file-label">Pilih Foto Profil Anda</label>
	 </div>
    </div>
    <button type="submit" class="btn btn-success" name="submit">
        Save Changes
    </button>
</form>
</div>