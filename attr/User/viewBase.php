<?php 

// Ambil Data Encode User
// Di url

$url = $_GET['q'];

// decode kembali 
$usr = base64_decode($url);

// Query Database User
// Berdasarkan decoding ($usr)
$query = "SELECT * FROM guild_info_member JOIN guild_role ON guild_role.id_role = guild_info_member.role WHERE full_name = '$usr'";
$data = mysqli_query($conn,$query);

$us = mysqli_fetch_assoc($data);

// Cek Jika Data Tidak Sama Di Database
if ($usr != $us['full_name']) {
    echo '<div class="alert alert-danger" role="alert">
      <h4 class="alert-heading display-3"> 404 Not Found </h4>
      <p class="mt-5 mb-0 text-uppercase"> User Tidak Ditemukan Dengan Alamat Url</p>
      <a href="'. base_url.'/attr/User/?mod=viewUser&q='. $_GET['q'] .'" class="font-italic small">'. base_url.'/attr/User/?mod=viewUser&q='. $_GET['q'] .' </a>
    </div>';

    return false;
}

?>

<!-- Tampilan User -->


<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile Saya</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div> -->

<div class="card shadow p-3 col-lg-6 mb-5 mx-auto mt-2 rounded" aria-hidden="true">
    <div class="d-sm-flex mb-2 flex-wrap">
        <?php if($us['foto_profil'] > 0) : ?>
        <a href="<?= base_url; ?>/assets/img/user-icon/<?= $us['foto_profil']?>" class="example-image-link"
            data-lightbox="example-image" data-title="<?= $us['full_name'] ?>">
            <img src="<?= base_url; ?>/assets/img/user-icon/<?= $us['foto_profil']?>" alt="Profil Saya"
                class="example-image img-profile rounded-circle">
        </a>
        <?php endif ?>
        <h2 class="h3 mx-3 text-primary"><?= $us['full_name']; ?>
            <p class="lead text-dark display-5"><?= substr($us['email'],0,-4) ?>
            </p>
        </h2>
    </div>

    <?php 

// String Tanggal Yg Akan Dipecah
$join = $us['tgl_join'];
$lahir = $us['tgl_lahir'];

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
$id = $us['guild_id'];

$guildSaya = "SELECT * FROM guild_center WHERE id_guild = '$id'";
$saya = mysqli_query($conn,$guildSaya);

$gl = mysqli_fetch_assoc($saya);

?>


    <hr class="my-2">

    <div class="mb-3 d-sm-flex flex-wrap btn btn-group">
        <a href="?mod=mail&data=<?= base64_encode($us['id_user']); ?>"
            class="btn btn-info mr-3 btn-sm rounded mb-2 mt-2"><i class="fa fa-comments fa-fw" aria-hidden="true"></i>
            Kirim Pesan </a>
        <a href="?mod=reportUser&data=<?= base64_encode($us['full_name']); ?>"
            class="btn btn-warning mr-3 btn-sm rounded mb-2 mt-2"><i class="fas fa-exclamation-circle fa-fw"></i>
            Laporkan </a>

        <?php if($detail['id_role'] !== '2') : ?>
        <a href="<?= base_url; ?>/attr/Admin/?mod=blockByAdmin&user=<?= base64_encode($us['id_user']); ?>"
            class="btn btn-danger mr-3 btn-sm rounded mb-2 mt-2"><i class="fa fa-ban" aria-hidden="true"></i> Blokir
        </a>
        <?php endif; ?>

    </div>

    <?php if($gl > 0) : ?>
    <span class="text-muted mb-2 float-right">Guild : <span class="text-primary"> <i class="fa fa-check-circle fa-fw"
                aria-hidden="true"></i> <?= $gl['guild_name'];?> </span> </span>
    <?php elseif(!$gl) : ?>
    <span class="badge badge-danger mb-2 float-right">Belum Memiliki Guild</span>
    <?php endif ?>

    <p class="small">Bergabung Sejak <?= $bulan; ?> <?= $tahun; ?>
    </p>

    <?php if( $us['is_aktif'] > 0): ?>
    <p class="small">
        Status : <span class="badge badge-success"> <?= $us['role']; ?> </span>

        <?php if($us['gender'] == '0'): ?>
        <span class="small">
            <i class="fa fa-venus-mars fa-fw text-primary" aria-hidden="true"></i> Unknown
        </span>
        <?php elseif($us['gender'] == '1'): ?>
        <span class="small">
            <i class="fa fa-mars-stroke-v fa-fw text-primary" aria-hidden="true"></i> Laki - Laki
        </span>
        <?php elseif($us['gender'] == '2'): ?>
        <span class="small">
            <i class="fas fa-venus fa-fw text-danger"></i> Perempuan
        </span>
        <?php endif ?>

    </p>

    <?php endif?>

    <?php if($us['biografi']) : ?>
    <div class="card small">
        <div class="card-body">
            <blockquote class="blockquote">
                <p>Biografi</p>
                <hr class="bg-secondary">
                <footer class="card-blockquote">
                    <p class="small"><?= $us['biografi']; ?>
                    </p>
                    <cite title="Source title" class="float-right mt-5 small display-4">~~ <?= $us['full_name']; ?>
                        ~~</cite>
                </footer>
            </blockquote>
        </div>
    </div>
    <?php endif ?>

</div>