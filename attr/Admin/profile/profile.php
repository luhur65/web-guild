
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile Saya</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">
<div class="jumbotron col-lg-8 mx-auto mt-3" id="userDropdown">
    <div class="d-inline-flex align-items-center justify-content-start mb-4 text-primary">
    <?php if($detail['foto_profil'] > 0) : ?>
    <img src="<?= base_url ?>/assets/img/user-icon/<?= $detail['foto_profil']?>" alt="Profil Saya" class="img-profile rounded-circle img-fluid">
    <?php endif ?>
    <h2 class="h3 mx-3 mr-2 d-lg-inline"><?= $detail['full_name']; ?>
    <p class="lead text-dark"><?= substr($detail['email'],0,-9)?>..
</p>
</h2>

    </div>

<?php 

// String Tanggal Yg Akan Dipecah
$join = $detail['tgl_join'];

// Memecah Tanggal dengan fungsi explode()
$pecah = explode('-',$join);

// Tanggal , Bulan , Tahun
$tanggal = $pecah['2'];
$tahun = $pecah['0'];

switch ($pecah['1']) {
    case '1':
        $bulan = "Januari";
        break;
    case '2':
        $bulan = "Februari";
        break;
    case '3':
        $bulan = "Maret";
        break;
    case '4':
        $bulan = "April";
        break;
    case '5':
        $bulan = "Mei";
        break;
    case '6':
        $bulan = "Juni";
        break;
    case '7':
        $bulan = "Juli";
        break;
    case '8':
        $bulan = "Agustus";
        break;
    case '9':
        $bulan = "September";
        break;
    case '10':
        $bulan = "Oktober";
        break;
    case '11':
        $bulan = "November";
        break;
    case '12':
        $bulan = "Desember";
        break;
}

?>

    <hr class="my-2">
    <p class="small">Bergabung Sejak <?= $bulan; ?> <?= $tahun; ?></p>
    <?php if( $detail['is_aktif'] > 0): ?>
    <p class="small">Status : <span class="badge badge-success"> Online </span> <span class="badge badge-info"> <?= $detail['role']; ?> </span> </p>
    <?php endif?>

<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>

   <?php if($detail['biografi']) : ?>
   <div class="card p-4 shadow border-0 text-dark">
    <span>Biografi Saya:</span>
    <hr>
    <p><?= $detail['biografi']; ?>.</p>
</div>
   <?php endif ?>

   <?php if(!$detail['biografi']|| !$detail['foto_profil']): ?>
   <div class="alert alert-info alert-dismissible fade show mt-5" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong><?= $_SESSION['log_'] ?></strong> Mohon Lengkapi Profil Anda !! .
    </div>
   <?php endif ?>

</div>

<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="" data-numposts="5"></div>


