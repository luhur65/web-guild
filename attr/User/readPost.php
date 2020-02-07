<?php 

$id = base64_decode($_GET['data']); 

// Data Postingan 
$dataPost = "SELECT * FROM guild_post JOIN guild_info_member ON guild_post.user_id = guild_info_member.id_user WHERE id_post = '$id'";

$queryData = query($dataPost);

?>

<div class="mx-auto">

    <?php foreach($queryData as $p) :?>

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
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">
                  <a href="<?= base_url; ?>/assets/img/user-icon/<?= $p['foto_profil']?>" class="example-image-link" data-lightbox="example-image" data-title="<?= $p['full_name'] ?>">
                <img src="<?= base_url; ?>/assets/img/user-icon/<?= $p['foto_profil']; ?>" class="img-fluid img-anggota rounded-circle">
                </a>


            <?php if($p['id_user'] == $detail['id_user']) :?>

                <a href="?mod=profile" class="h6"><?= $p['full_name']; ?></a>
            <?php else : ?>

                <a href="?mod=viewUser&q=<?= base64_encode($p['full_name'])?>" class="h6"><?= $p['full_name']; ?></a>

            <?php endif ?>
          
                  </h6>
                  <?php if($p['id_user'] == $detail['id_user']) :?>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item text-info" href="?mod=editMyPost&data=<?= base64_encode($p['id_post']) ?>"><i class="fas fa-edit fa-fw"></i> Edit</a>
                  <a class="dropdown-item text-danger" href="?mod=hapusPostingan&data=<?= base64_encode($p['id_post']) ?>" onclick="return confirm('Anda Yakin ??')"><i class="fas fa-trash-alt fa-fw"></i> Hapus</a>
                    </div>
                  </div>
                  <?php else : ?>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-dark"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item text-info" href="?mod=viewUser&q=<?= base64_encode($p['full_name'])?>">
                      <i class="fas fa-user fa-fw"></i> Lihat Profil
                  </a>
                  <a href="?mod=reportUser&data=<?= base64_encode($p['full_name']); ?>" class="dropdown-item text-danger"> <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i> Laporkan Ini</a>
                    </div>
                  </div>

                  <?php endif ?>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <p class="small badge badge-info">
                      <?= $p['full_name']; ?>
                    </p>
                  <span class="small badge badge-dark"> <?= $date[2] ." " . $bul ." ". $date[0]; ?>  </span>
                  <p class="lead">
                      <?= $p['post']; ?>
                  </p>
                </div>
              </div>
            </div>

    <?php endforeach ?>
</div>
