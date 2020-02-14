<?php 

// List Guild ( Dibuat oleh Admin )
// Membuat daftar guild
$semuaGuild = "SELECT * FROM guild_center WHERE guild_post = 'Public' And guild_aktif = 1";

// Query Semua Daftar Guild Untuk Join
$join = query($semuaGuild);

if ($detail['guild_id'] > 0) {
    echo '<div class="alert alert-danger" role="alert">
      <h4 class="alert-heading display-3">404 Founded</h4>
      <p>Anda Sudah Punya Guild ....</p>
      <p class="mb-0">Tidak Boleh Join Melebihi batas maksimum ...</p>
      <p class="mb-0">Anda Hanya Punya 1 Slot untuk join dengan 1 guild yg Ada...</p>
    </div>';

    return false;
}

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Join To Guild</h1>
  <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-secondary">

<?php if (isset($_POST['joinGuild'])) {
    if (joinToGuild($_POST) > 0) {
        echo showMessage('success','Selamat','Anda Telah Bergabung Di Guild '. $_POST['namaGuild'] .'');
        echo "<script>document.location.href='?mod=profile'</script>";
    } else {
        echo showMessage('danger','Gagal','Something Wrong Happen , Sorry');
    }
}

?>


<!-- <div class="p-3">
  <form class="form-inline my-2 my-lg-0" action="" method="POST">
    <input class="form-control mr-sm-2" type="text" placeholder="Search Guild To Join" name="keyword">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search"><i class="fa fa-search fa-fw" aria-hidden="true"></i> Search</button>
  </form>
</div> -->

<!-- Guild List -->
<section class="content-section p-3" id="guild">
  <div class="row no-gutters">

    <?php foreach($join as $j) : ?>
    <div class="col-lg-4">
      <a class="portfolio-item shadow rounded mr-2 mb-2" href="#">
        <span class="caption">
          <span class="caption-content small">
            <h2><?= $j['guild_name'] ?></h2>
            <p class="mb-0">
              <?= substr($j['guild_info'],0,35)  ?>
            </p>
            <form action="" method="post" class="mt-2">
              <input type="hidden" name="namaGuild" value="<?= $j['guild_name'] ?>" readonly>
              <input type="hidden" name="indexGuildId" value="<?= $j['id_guild'] ?>" readonly>
              <input type="hidden" name="idUserToJoin" value="<?= $detail['id_user'] ?>" readonly>
              <button type="submit" class="btn btn-danger btn-sm" name="joinGuild">
                Join Now!
              </button>
            </form>
          </span>
        </span>
        <img class="img-fluid" src="<?= base_url; ?>/assets/img/guild_img/<?= $j['guild_img'] ?>" alt="Guild Image">
      </a>
    </div>
    <?php endforeach ?>

  </div>
</section>