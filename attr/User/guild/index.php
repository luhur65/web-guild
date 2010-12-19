<?php

// Id Guild dari URL
$id = base64_decode($_GET['idGuild']);

// Guild
$dataGuild = "SELECT * FROM guild_info_member JOIN guild_center On guild_center.id_guild = guild_info_member.guild_id WHERE guild_info_member.guild_id = '$id'";
$guildSaya = mysqli_query($conn,$dataGuild);

$gl = mysqli_fetch_assoc($guildSaya);

// Jika Guild Di block oleh Admin
if ($gl['guild_aktif'] === '0') {
    echo showMessage('danger','Blocked','Kami Memblokir Guild Ini Untuk Sementara Waktu Sampai Masa Waktu Yg Telah Kami Tentukan Sendiri!!, Terima Kasih');

    return false;
}

// mengambil Profil User Guild
// Sebanyak 5 user
$profilUser = "SELECT * FROM guild_info_member JOIN guild_center ON guild_center.id_guild = guild_info_member.guild_id WHERE guild_info_member.guild_id = '$id' LIMIT 5";
$profil = query($profilUser);


// Hitung Anggota Guild
$anggota = count(query($dataGuild));

// jika belum join guild 
if (!$gl) {
  echo '<div class="alert alert-danger" role="alert">
        <h3 class="alert-heading font-weight-bold">Not Found</h3>
        <p>Anda Belum Memiliki Guild!</p>
        <p class="mb-0">Silakan Join Atau Create Guild Dulu!</p>
      </div>';

    return false;
}


$admin = "SELECT * FROM guild_center INNER JOIN guild_info_member ON guild_info_member.id_user = guild_center.creator WHERE guild_center.id_guild = '$id'";
$queryAdmin = query($admin);

?>

<!-- Tampilan Web Guild Saya -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Guild Saya</h1>
  <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>

<hr class="bg-primary">

<div class="row rounded mb-5">

  <div class="col-lg-4 mb-3">
    <div class="card shadow">
      <img src="<?= base_url; ?>/assets/img/guild_img/<?= $gl['guild_img']; ?>" alt="" class="img-fluid banner">
      <div class="card-body text-center">
        <h3 class="card-title text-uppercase text-dark"><?= $gl['guild_name']; ?></h3>
        <!-- <h6 class="card-subtitle text-muted"><?= $gl['guild_info']; ?></h6> -->
        <hr class="bg-primary">
        <div class="dropdown mt-3 btn">
          <a href="?mod=undangTeman" class="btn btn-primary btn-sm mb-3"> <i class="fas fa-user-plus fa-fw"></i> Ajak
            Teman</a>
          <a href="?mod=getOutFromGuild&user=<?= $detail['id_user'];?>" class="btn btn-danger btn-sm mb-3"><i
              class="fas fa-sign-out-alt" aria-hidden="true"></i> Keluar</a>
          <button class="btn btn-info btn-sm dropdown-toggle mb-3" type="button" id="triggerId" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-exclamation-circle fa-fw"></i> Lainnya
          </button>
          <div class="dropdown-menu" aria-labelledby="triggerId">
            <a class="dropdown-item btn btn-link"
              href="?mod=listMember&data=<?= base64_encode($gl['id_guild']); ?>"><i class="fas fa-users fa-fw"></i>
              List Member</a>
            <?php 
        
       foreach ($queryAdmin as $key) {
          $owner = $key['full_name'];
          
          if ($detail['full_name'] === $owner) {
              echo '<a class="dropdown-item btn btn-link" href="?mod=editData&data='. base64_encode($gl['id_guild']) .'"><i class="fas fa-edit fa-fw"></i> Edit Guild</a>';
              
              if ($key['guild_post'] === 'Private') {
                echo '<a class="dropdown-item btn btn-link" href="?mod=setPassword&data='. base64_encode($gl['id_guild']) .'"><i class="fas fa-lock fa-fw"></i> Set Password</a>';
              }
          }
       }
        
        ?>
          </div>
        </div>
      </div>

      <div class="card border-0 mt-0">
        <div class="card-body text-center">
          <blockquote class="blockquote">
            <p class="small">Informasi Guild</p>
            <hr>
            <footer class="card-blockquote shadow p-3">
              " <?= $gl['guild_info']; ?> "
            </footer>
          </blockquote>
        </div>
      </div>


      <?php 

    // Username User 
    // Dari session
    $user = $_SESSION['log_'];
    
    // User Mengupload Postingan
    $arrayUser = "SELECT * FROM guild_info_member JOIN guild_center On guild_center.id_guild = guild_info_member.guild_id WHERE guild_info_member.guild_id = '$id' and guild_info_member.username = '$user'";
    $viewUser = query($arrayUser);

    // Jika tombol Kirim Diklik
    if (isset($_POST['kirimPost'])) {
        if (sendMyPost($_POST) > 0) {
          echo alertPopUp('Berhasil Memposting','?mod=home');
        } else {
          echo showMessage('danger','Gagal','Something Wrong Happen , Please Go to another Page');
        }
    }
    
    ?>

    </div>

    <div class="card mt-3 shadow">
      <div class="card-body">
        <h4 class="text-muted mb-3">Admin Guild</h4>
        <?php foreach($queryAdmin as $im): ?>
        <?php if($im['foto_profil'] > 0) :?>
        <p class="d-block">
          <img src="<?= base_url; ?>/assets/img/user-icon/<?= $im['foto_profil']; ?>"
            class="img-anggota img-fluid rounded-circle" alt=""> <?= $im['full_name']; ?>
        </p>
        <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="card-body">
        <h4 class="text-muted mb-4">Anggota Member</h4>
        <?php foreach($profil as $img): ?>
        <?php if($img['foto_profil'] > 0) :?>
        <p class="d-block">
          <img src="<?= base_url; ?>/assets/img/user-icon/<?= $img['foto_profil']; ?>"
            class="img-anggota img-fluid rounded-circle" alt=""> <?= $img['full_name']; ?>
        </p>
        <?php endif ?>
        <?php endforeach ?>

        <?php if($anggota > 0) : ?>
        Jumlah Member : <?= $anggota; ?> Anggota
        <?php endif ?>
      </div>
    </div>

  </div>


  <div class="col-lg">

    <?php foreach($viewUser as $me) : ?>
    <div class="card shadow p-4">
      <div class="mt-0">
        <form action="" method="post">
          <input type="hidden" name="idUser" value="<?= $me['id_user'] ;?>" readonly>
          <input type="hidden" name="idGuild" value="<?= $me['guild_id'] ;?>" readonly>
          <div class="form-group row">
            <div class="col-sm">
              <label for="post">
                <?php if(!$me['foto_profil']) : ?>
                <?= $me['full_name']; ?>
                <?php else: ?>
                <img src="<?= base_url; ?>/assets/img/user-icon/<?= $me['foto_profil'] ?>" class="rounded img-anggota"
                  alt="Profile">
                <?= $me['full_name']; ?>
                <?php endif ?>
              </label>
            </div>
            <div class="col-sm-12">
              <textarea class="form-control" name="post" id="post" rows="3" placeholder="Tulis Postingan Anda"
                required></textarea>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success btn-sm" name="kirimPost">Kirim Postingan</button>
          </div>
        </form>
      </div>
    </div>

    <?php endforeach ?>

    <?php 

  // Data Postingan
  $dataPost = "SELECT * FROM guild_post JOIN guild_center ON guild_center.id_guild = guild_post.id_guild JOIN guild_info_member ON guild_info_member.id_user = guild_post.user_id WHERE guild_center.id_guild = '$id' Order By id_post DESC ";
  $queryPost = query($dataPost);

  $jmlPost = count($queryPost);

  if ($jmlPost > 0) {
       echo '<!-- Tampilan Web Guild Saya -->
       <div class="d-sm-flex align-items-center justify-content-between mb-3">
           <h1 class="h3 mt-5 text-gray-800">Postingan Terbaru</h1>
           <span class="text-muted small mt-5">'.date('l , d M Y').'</span>
       </div>
       <hr class="bg-dark">';
  }

  ?>

    <?php foreach($queryPost as $p): ?>

    <?php if($queryPost > 0) : ?>

    <!-- Postingan Seluruh Member Group -->
    <div class="card mt-5 shadow ">
      <div class="card-header bg-gradient">
        <img src="<?= base_url; ?>/assets/img/user-icon/<?= $p['foto_profil']; ?>"
          class="img-fluid img-anggota rounded-circle"> 
          <?php if($detail['id_user'] === $p['id_user']) : ?>
          <?= $p['full_name']; ?>
          <?php else : ?>
          <a href="?mod=viewUser&q=<?= base64_encode($p['full_name'])?>"><?= $p['full_name']; ?></a>
          <?php endif; ?>
      </div>
      <div class="card-body">
        <?php  if($p['guild_id'] != $p['id_guild']) : ?> <p class="small"> <span class="badge badge-danger">
            <?= $p['full_name']; ?> Telah Keluar Dari Guild <?= $p['guild_name']; ?>
          </span> </p> <?php endif ?>
        <p class="card-text">
          <?php if(strlen($p['post']) > 500) :?>
          <?= substr($p['post'],0,500); ?> ... <a href="?mod=seeMore&data=<?= base64_encode($p['id_post']) ?>"
            class="btn btn-link">Lihat Selengkapnya</a>
          <?php else : ?>
          <?= $p['post']; ?>
          <?php endif ?>
        </p>
        <p class="small">
          <?php
            
            // Ambil Waktu Sekarang
            $now = time();

            // Waktu Upload Postingan
            $postDate = $p['post_date'];
            $array = explode(' ',$p['post_date']);

            // Ambil Date Dan Time Kemudian Explode Lagi
            $date = explode('-',$array[0]);
            $tanggal = $date[2];
            $bulan = $date[1];
            $tahun = $date[0];

            // $time = explode(':',$array[1]);
            // $jam = $time[0];
            // $menit = $time[1];
            // $detik = $time[2];

            // Switch
            switch ($bulan) {
              case '1':
                $bulan = 'Januari';
                break;
              case '2':
                $bulan = 'Februari';
                break;
              case '3':
                $bulan = 'Maret';
                break;
              case '4':
                $bulan = 'April';
                break;
              case '5':
                $bulan = 'Mei';
                break;
              case '6':
                $bulan = 'Juni';
                break;
              case '7':
                $bulan = 'Juli';
                break;
              case '8':
                $bulan = 'Agustus';
                break;
              case '9':
                $bulan = 'September';
                break;
              case '10':
                $bulan = 'Oktober';
                break;
              case '11':
                $bulan = 'November';
                break;
              case '12':
                $bulan = 'Desember';
                break;
            }
            echo $tanggal .' '. $bulan .' '. $tahun;
            ?>
        </p>
      </div>
    </div>
    <?php endif ?>

    <?php endforeach ?>

  </div>
</div>