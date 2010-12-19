<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile Saya</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div> -->

<div class="row">
    <div class="card shadow rounded p-4 col-lg-6  mt-2 mb-5">
        <div class="d-inline-flex flex-wrap mb-4">
            <?php if($detail['foto_profil'] > 0) : ?>
            <a href="<?= base_url; ?>/assets/img/user-icon/<?= $detail['foto_profil']?>" class="example-image-link"
                data-lightbox="example-image" data-title="<?= $detail['full_name'] ?>">
                <img src="<?= base_url; ?>/assets/img/user-icon/<?= $detail['foto_profil']?>" alt="Profil Saya"
                    class="example-image img-profile rounded-circle">
            </a>
            <?php endif ?>
            <h2 class="h3 mx-3 d-sm-inline text-primary"><?= $detail['full_name']; ?>
                <p class="lead text-dark display-5"><?= substr($detail['email'],0,-4) ?>
                </p>
            </h2>
        </div>

        <?php 

// String Tanggal Yg Akan Dipecah
$join = $detail['tgl_join'];
$lahir = $detail['tgl_lahir'];

// Memecah Tanggal dengan fungsi explode()
$pecah = explode('-',$join);
$pecahLahir = explode('-',$lahir);

// Waktu Lahir
$tglLahir = $pecahLahir['2'];
$thnLahir = $pecahLahir['0'];
$bulanLahir = $pecahLahir['1'];

// Waktu Join
// Tanggal , Bulan , Tahun 
$tanggal = $pecah['2'];
$tahun = $pecah['0'];
$bulan = $pecah['1'];

// bulan join
switch ($bulan) {
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
// bulan join
switch ($bulanLahir) {
    case '1':
        $blnLahir = "Januari";
        break;
    case '2':
        $blnLahir = "Februari";
        break;
    case '3':
        $blnLahir = "Maret";
        break;
    case '4':
        $blnLahir = "April";
        break;
    case '5':
        $blnLahir = "Mei";
        break;
    case '6':
        $blnLahir = "Juni";
        break;
    case '7':
        $blnLahir = "Juli";
        break;
    case '8':
        $blnLahir = "Agustus";
        break;
    case '9':
        $blnLahir = "September";
        break;
    case '10':
        $blnLahir = "Oktober";
        break;
    case '11':
        $blnLahir = "November";
        break;
    case '12':
        $blnLahir = "Desember";
        break;
}

// Guild Saya
$id = $detail['guild_id'];

$guildSaya = "SELECT * FROM guild_center WHERE id_guild = '$id'";
$saya = mysqli_query($conn,$guildSaya);

$gl = mysqli_fetch_assoc($saya);
?>


        <hr class="my-2">
        <?php if($gl > 0) : ?>
        <span class="text-muted mb-2 float-right">Guild : <span class="text-primary"> <i
                    class="fa fa-check-circle fa-fw" aria-hidden="true"></i> <?= $gl['guild_name'];?> </span> </span>
        <?php elseif(!$gl) : ?>
        <span class="badge badge-danger mb-2 float-right">Belum Memiliki Guild</span>
        <?php endif ?>
        <p class="small">Bergabung Sejak <?= $bulan; ?> <?= $tahun; ?></p>
        <?php if( $detail['is_aktif'] > 0): ?>
        <p class="small">Status : <span class="badge badge-success"> Online </span> <span class="badge badge-warning">
                <?= $detail['role']; ?> </span> </p>
        <?php endif?>
        <?php if($detail['biografi']) : ?>
        <div class="card">
            <div class="card-body">
                <blockquote class="blockquote small">
                    <!-- <p>Biografi Saya</p> -->
                    <footer class="card-blockquote text-break">
                        <?= $detail['biografi']; ?>
                        <cite title="Source title" class="float-right mt-5 small display-4">~~
                            <?= $detail['full_name']; ?> ~~</cite>
                    </footer>
                </blockquote>
            </div>
        </div>
        <?php endif ?>
        <?php if(!$detail['biografi']|| !$detail['foto_profil']): ?>
        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong><?= $_SESSION['log_'] ?></strong> Mohon Lengkapi Profil Anda !! .
        </div>
        <?php endif ?>

        <div class="card text-center mt-5">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-birthday-cake fa-2x fa-fw text-primary"></i></h4>
                <p class="card-text text-dark">Lahir Pada Tanggal <?= $tglLahir; ?> <?= $blnLahir; ?> <?= $thnLahir; ?>
                </p>
                <?php if($detail['gender'] == '0'): ?>
                <span class="small">
                    <i class="fa fa-venus-mars fa-fw text-primary" aria-hidden="true"></i> Unknown
                </span>
                <?php elseif($detail['gender'] == '1'): ?>
                <span class="small">
                    <i class="fa fa-mars-stroke-v fa-fw text-primary" aria-hidden="true"></i> Laki - Laki
                </span>
                <?php elseif($detail['gender'] == '2'): ?>
                <span class="small">
                    <i class="fas fa-venus fa-fw text-danger"></i> Perempuan
                </span>
                <?php endif ?>
            </div>
        </div>

    </div>
</div>