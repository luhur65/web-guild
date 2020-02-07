<!-- Judul Halaman -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Saya</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">
<?php 
// Menghitung Jumlah Anggota
$roleAnggota = "SELECT * FROM guild_info_member WHERE role = '2'";
$queryAnggota = query($roleAnggota);

?>
<div class="row">
<!-- Jumlah Anggota  -->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
     <div class="card-body">
       <div class="row no-gutters align-items-center">
         <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Akun Anggota</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
            <?= count($queryAnggota); ?> Anggota
         </div>
        </div>
      <div class="col-auto">
     <i class="fas fa-users fa-2x text-gray-300"></i>
    </div>
   </div>
  </div>
 </div>
</div> 

