<!-- Judul Halaman -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
  <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">
<?php 

// Menghitung Jumlah Anggota
$anggota = query("SELECT * FROM `guild_info_member` WHERE role = '2'");

// Menghitung Jumlah Guild
$guild = query("SELECT * FROM `guild_center` ");

// menghitung jumlah menu
$menu = query("SELECT * FROM `menu` ");

// Menghitung Jumlah Submenu 
$submenu = query("SELECT * FROM `sub_menu` ");

?>
<div class="row">
  <!-- Jumlah Anggota  -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Anggota</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= count($anggota); ?> Anggota
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jumlah Guild -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Guild</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= count($guild); ?> Guild
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Jumlah Menu -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Menu</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= count($menu); ?> Menu
            </div>
          </div>
          <div class="col-auto">
            <i class="fa fa-folder fa-2x text-gray-300" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Jumlah Submenu -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data SubMenu</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= count($submenu); ?> Submenu
            </div>
          </div>
          <div class="col-auto">
            <i class="fa fa-list fa-2x text-gray-300" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="row">

<!-- List Anggota -->
<div class="col-lg-8 mb-3 mt-3">
<div class="card mb-4 shadow rounded border-left-primary shadow h-100">
  <div class="card-body">
    <div class="h3 mb-4 text-gray-800">List Anggota</div> <hr class="bg-dark">
    <table class="table table-hover table-inverse table-responsive text-center">
      <thead class="thead-inverse">
        <tr>
          <th>Foto Profil</th>
          <th>Nama Lengkap</th>
          <th>Status Akun</th>
          <th>Action</th>
          <th>More Info Details...</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($anggota as $a) : ?>
        <tr>
          <td>
            <img src="<?= base_url; ?>/assets/img/user-icon/<?= $a['foto_profil']; ?>"
              class="img-fluid img-thumbnail rounded-circle" alt="">
          </td>
          <td><?= $a['full_name']; ?></td>
          <td>
            <?php if($a['is_aktif'] > 0) : ?>
            <p><span class="badge badge-primary">Active</span></p>
            <?php elseif($a['is_aktif'] < 1) : ?>
            <p><span class="badge badge-danger">Diblokir</span></p>
            <?php endif; ?>
          </td>
          <td>
            <?php if($a['is_aktif'] > 0) : ?>
            <a href="?mod=blockByAdmin&amp;user=<?= base64_encode($a['id_user']) ?>" class="btn btn-danger btn-sm rounded">
              <i class="fa fa-ban fa-fw" aria-hidden="true"></i> Blokir Akun
            </a>
            <?php elseif($a['is_aktif'] < 1) : ?>
            <a href="?mod=openAccess&amp;user=<?= base64_encode($a['id_user']) ?>" class="btn btn-primary btn-sm rounded">
              <i class="fas fa-user-check fa-fw"></i> Aktifkan Akun
            </a>
            <?php endif; ?>
          </td>
          <td><a href="<?= base_url; ?>/attr/User/?mod=viewUser&amp;q=<?= base64_encode($a['full_name']); ?>" class="btn btn-link btn-sm btn-block">
          <i class="fa fa-eye fa-fw" aria-hidden="true"></i> Details ....
          </a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>


<div class="col-lg-4 mb-3 mt-3">
<div class="card shadow border-left-success">
  <div class="card-body">
    <div class="h3 mb-4 text-gray-800">List Guild</div> <hr class="bg-dark">
      <!-- Isi Konten  -->
  </div>
</div>
</div>


</div>