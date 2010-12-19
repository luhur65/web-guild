<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Beranda Saya</h1>
  <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark mb-3">

<?php 

if ($detail['id_role'] !== '2') {
    echo '<div class="alert alert-info" role="alert">
      <p>You Login As Admin , This Not Your Home Page. Please Klik The Button Below</p>
      <a href="'.base_url.'/attr/Admin" class="btn btn-primary">Back To My Home Page</a>
    </div>';
}

// user yg guildnya sama
$id = $detail['guild_id']; 

  // Data Postingan
  $dataPost = "SELECT * FROM guild_post JOIN guild_center ON guild_center.id_guild = guild_post.id_guild JOIN guild_info_member ON guild_info_member.id_user = guild_post.user_id WHERE guild_center.id_guild = '$id' Order By id_post DESC ";
  $queryPost = query($dataPost);

?>

<div class="mx-auto">

  <?php foreach($queryPost as $p) :?>

  <?php if($p['id_guild'] === $p['guild_id']) : ?>

  <?php 
    
    // Menghitung Panjang Nama Usr
    $nama = explode(" ",$p['full_name']);
    $panjangNama = count(explode(" ",$p['full_name']));

    // Memecahkan Bulan , Tanggal , dan Tahun (Jam , Mennit , detik)
    $array = explode(' ',$p['post_date']);

    // Ambil Tanggal
    $date = $array[0];
    
    // Pecahkan Kembali
    $date = explode('-',$date);
    $moon = $date[1];
    
    // Swicth
    switch ($moon) {
        case '1':
            $bul = "Januari";
            break;
        case '2':
            $bul = "Februari";
            break;
        case '3':
            $bul = "Maret";
            break;
        case '4':
            $bul = "April";
            break;
        case '5':
            $bul = "Mei";
            break;
        case '6':
            $bul = "Juni";
            break;
        case '7':
            $bul = "Juli";
            break;
        case '8':
            $bul = "Agustus";
            break;
        case '9':
            $bul = "September";
            break;
        case '10':
            $bul = "Oktober";
            break;
        case '11':
            $bul = "November";
            break;
        case '12':
            $bul = "Desember";
            break;

    }

    ?>

  <div class="mx-auto">
    <div class="card bg-white mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header border-0 bg-white d-flex flex-row align-items-center justify-content-between mb-0">
        <h6 class="m-0 font-weight-bold text-primary">
          <a href="<?= base_url; ?>/assets/img/user-icon/<?= $p['foto_profil']?>" class="example-image-link"
            data-lightbox="<?= $p['foto_profil']?>" data-title="<?= $p['full_name'] ?>">
            <img src="<?= base_url; ?>/assets/img/user-icon/<?= $p['foto_profil']; ?>"
              class="img-fluid img-anggota rounded-circle">
          </a>

          <?php if($panjangNama >= 3) : ?>

          <?php if($p['id_user'] == $detail['id_user']) :?>
          <a href="?mod=profile" class="h6"><?= $nama[0] . " " . $nama[1]; ?> ...</a>
          <?php else : ?>
          <a href="?mod=viewUser&q=<?= base64_encode($p['full_name'])?>" class="h6"><?= $nama[0] . " " . $nama[1]; ?>
            ...</a>
          <?php endif ?>

          <?php elseif($panjangNama < 3) : ?>

          <?php if($p['id_user'] == $detail['id_user']) :?>
          <a href="?mod=profile" class="h6"><?= $p['full_name']; ?></a>
          <?php else : ?>
          <a href="?mod=viewUser&q=<?= base64_encode($p['full_name']) ?>" class="h6"><?= $p['full_name'] ?></a>
          <?php endif ?>

          <?php endif ?>

          &raquo;<a href="?mod=viewMyGuildID&idGuild=<?= base64_encode($p['id_guild']); ?>"
            class="mx-2 font-weight-bold"><?= $p['guild_name']; ?></a>

        </h6>
        <?php if($p['id_user'] == $detail['id_user']) :?>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item text-info" href="?mod=editMyPost&data=<?= base64_encode($p['id_post']) ?>"><i
                class="fas fa-edit fa-fw"></i> Edit</a>
            <a class="dropdown-item text-danger" href="?mod=hapusPostingan&data=<?= base64_encode($p['id_post']) ?>"
              onclick="return confirm('Anda Yakin ??')"><i class="fas fa-trash-alt fa-fw"></i> Hapus</a>
          </div>
        </div>
        <?php else : ?>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-dark"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item text-info" href="?mod=viewUser&q=<?= base64_encode($p['full_name'])?>">
              <i class="fas fa-user fa-fw"></i> Lihat Profil
            </a>
            <a href="?mod=reportUser&data=<?= base64_encode($p['full_name']); ?>" class="dropdown-item text-danger"> <i
                class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i> Laporkan Ini</a>
          </div>
        </div>

        <?php endif ?>
      </div>
      <!-- Card Body -->
      <div class="card-body mt-0">

        <p class="small badge badge-info">
          <?= $p['full_name']; ?>
        </p>
        <span class="small badge badge-dark"> <?= $date[2] ." " . $bul ." ". $date[0]; ?> </span>
        <p class="lead">
          <?php if(strlen($p['post']) > 500) :?>
          <?= substr($p['post'],0,500); ?> ... <a href="?mod=seeMore&data=<?= base64_encode($p['id_post']) ?>"
            class="btn btn-link">Lihat Selengkapnya</a>
          <?php else : ?>
          <?= $p['post']; ?>
          <?php endif ?>
        </p>

        <?php 

          $idPost = $p['id_post'];

          // jumlah like 
          $dataLike = "SELECT * FROM data_like_post WHERE id_post_like = '$idPost'";

          // jumlah like
          $like = count(query($dataLike));
          
          // orang yg like
          $idLikers = $detail['id_user'];
          $dataLikers = "SELECT id_post_like, id_user_like FROM data_like_post WHERE id_post_like = '$idPost' and id_user_like = '$idLikers'";
          $show = mysqli_query($conn, $dataLikers);
          $sw = mysqli_fetch_assoc($show);

          ?>


        <!-- like , comment -->
        <?php if($idLikers === $sw['id_user_like']): ?>
        <a href="#" class="btn btn-outline-light btn-sm mb-0 countLike text-danger like-button"
          data-id="<?= $p['id_post']; ?>">
          <?php if($like > 0) : ?>
          <i class="fa fa-heart fa-fw" aria-hidden="true"></i> <?= $like; ?> </a>
        <?php else : ?>
        <i class="fa fa-heart fa-fw" aria-hidden="true"></i> Like </a>
        <?php endif; ?>
        <?php elseif($idLikers !== $sw['id_user_like']): ?>
        <a href="#" class="btn btn-light btn-sm mb-0 text-dark like-button" data-id="<?= $p['id_post']; ?>">
          <?php if($like > 0) : ?>
          <i class="fa fa-heart fa-fw" aria-hidden="true"></i> <?= $like; ?> </a>
        <?php else : ?>
        <i class="fa fa-heart fa-fw" aria-hidden="true"></i> Like </a>
        <?php endif; ?>
        <?php endif; ?>

        <?php 

          // data comment / banyak commentar
          $dataCommentar = "SELECT * FROM `data_comment` JOIN `guild_post` ON guild_post.id_post = data_comment.id_comment_post WHERE id_post = '$idPost'";

          $count = count(query($dataCommentar));

        ?>


        <a href="?mod=seeMore&amp;data=<?= base64_encode($p['id_post']) ?>" class="btn btn-link text-primary mb-0 btn-sm"><i class="fa fa-comments fa-fw" aria-hidden="true"></i>
          <?= $count = ($count > 0) ? "$count":"" ?> Comment</a>
        <!-- akhir dari like, comment -->
      </div>
    </div>
  </div>

  <?php endif ?>

  <?php endforeach ?>
</div>