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

<!-- edit profile -->
<div class="card shadow p-4 rounded text-dark mb-3">
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
      <input type="text" name="full_name" id="namaLengkap" class="form-control" value='<?= $detail['full_name'] ?>'
        aria-describedby="helpId" required>
      <small id="helpId" class="text-muted"></small>
    </div>
    <div class="form-group">
      <label for="email">Email Anda</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId"
        value="<?= $detail['email'] ?>" readonly>
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
      <img width="120" src="<?= base_url; ?>/assets/img/user-icon/<?= $detail['foto_profil'] ?>"
        class="img-fluid img-profile rounded mb-3">
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

<!-- setting profile & danger zone -->
<?php if($detail['id_role'] === '2') : ?>
<div class="card shadow mb-5">
  <div class="card-body">
    <h4 class="card-title text-danger"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> Danger Zone </h4>

    <div class="card mt-3">
      <div class="card-body">

      <div class="alert alert-warning" role="alert">
      <strong>Note :</strong> Semua Tindakan Dibawah Ini Tidak Dapat Dibatalkan!
    </div>

          <!-- delete account -->
          <div class="row mb-4">
            <div class="col-lg-7">
              <label for="deleteAccount">
                <p class="font-weight-bold text-dark">1. Hapus Akun Saya untuk selamanya ( <span class="text-info">Akun anda akan hilang secara permanen</span> ) </p>
              </label>
            </div>
            <div class="col-lg-3 mt-0">
              <a href="#" class="btn btn-outline-danger deleteAkun" data-user="<?= $detail['id_user']; ?>" id="deleteAccount"><i class="fa fa-trash fa-fw" aria-hidden="true"></i>  Delete Account</a>
            </div>
          </div>
          
          <!-- deactivated account -->
          <div class="row mb-4">
            <div class="col-lg-7">
              <label for="nonaktifkaAkun">
                <p class="font-weight-bold text-dark">2. Non-aktifkan akun saya , untuk selamanya ( <span class="text-info">Hanya Admin yg bisa mengaktifkan kembali akun anda</span> ) </p>
              </label>
            </div>
            <div class="col-lg-3 mt-0">
              <a href="#" class="btn btn-outline-danger nonaktifkanAkun" id="nonaktifkanAkun" data-user="<?= $detail['id_user']; ?>"> <i class="fa fa-times fa-fw" aria-hidden="true"></i> Disable Account</a>
            </div>
          </div>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>