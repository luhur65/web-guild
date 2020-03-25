<?php

if (!isset($_SESSION['log_'])) {
    header('Location: ../login');
    exit;
}

// Query Data Guild
$guild_session = $_SESSION['log_'];
$data_query = "SELECT * FROM guild_center JOIN guild_info_member ON guild_center.creator = guild_info_member.id_user";
$query    = query($data_query);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">List Guild</h1>
  <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">


<div class="row">
  <?php foreach($query as $listGuild) : ?>
  <div class="col-lg-3">
    <div class="card mb-5">
      <img class="card-img-top img-fluid" src="<?= base_url; ?>/assets/img/guild_img/<?= $listGuild['guild_img']; ?>"
        alt="">
      <div class="card-body text-center">
        <h3 class="card-title bg-gradient rounded shadow p-3 text-dark text-uppercase small font-weight-bold">
          <?= $listGuild['guild_name'] ?></h3>
        <?php if($listGuild['guild_aktif'] < 1): ?>

        <p class="small">
          <span class="badge badge-danger">Guild Blocked</span>
        </p>

        <?php endif ?>
        <p class="card-text"><?= $listGuild['guild_info'] ?></p>

        <?php if($listGuild['guild_post'] === 'Public'): ?>

        <span class="text-success">Group <?= $listGuild['guild_post']; ?></span> <br>

        <a href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($listGuild['full_name']) ?>"
          class="btn btn-link btn-sm rounded"><i class="fas fa-user-shield fa-fw"></i>
          <?= $listGuild['full_name']; ?></a>

        <?php elseif($listGuild['guild_post'] === 'Private'): ?>

        <span class="text-danger">Group <?= $listGuild['guild_post']; ?></span> <br>

        <a href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($listGuild['full_name']) ?>"
          class="btn btn-link btn-sm rounded"><i class="fas fa-user-shield fa-fw"></i>
          <?= $listGuild['full_name']; ?></a>

        <?php endif ?>

      </div>
      <div class="card-footer">
        <a href="<?= base_url; ?>/attr/User/?mod=viewMyGuildID&idGuild=<?= base64_encode($listGuild['id_guild']); ?>"
          class="btn btn-primary mb-2 btn-circle">
          <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
        </a>

        <a href="?mod=editData&data=<?= base64_encode($listGuild['id_guild']); ?>" class="btn btn-info mb-2 btn-circle"
          onclick="return confirm('Anda Yakin Ingin Mengedit Data Guild Ini ??')">
          <i class="fas fa-edit fa-fw"></i>
        </a>
        <?php if($listGuild['guild_aktif'] > 0)  :?>
        <a href="" class="btn btn-warning mb-2 btn-circle blockirGuild"
          data-guild="<?= base64_encode($listGuild['id_guild']); ?>">
          <i class="fa fa-ban fa-fw" aria-hidden="true"></i>
        </a>
        <?php elseif($listGuild['guild_aktif'] < 1)  :?>
        <a href="" class="btn btn-success mb-2 btn-circle aktifkanGuild"
          data-guild="<?= base64_encode($listGuild['id_guild']); ?>">
          <i class="fa fa-check-circle fa-fw" aria-hidden="true"></i>
        </a>
        <?php endif; ?>
        <a href="?mod=deleteGuildFromlist&data-guild=<?= base64_encode($listGuild['id_guild']); ?>" class="btn btn-danger mb-2 btn-circle hapusGuild"> 
          <i class="fas fa-trash-alt fa-fw"></i>
        </a>

      </div>
    </div>
  </div>
  <?php endforeach ?>
</div>
