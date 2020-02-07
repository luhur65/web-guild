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
    <div class="card mb-5 text-center">
      <img class="card-img-top img-fluid" src="<?= base_url; ?>/assets/img/guild_img/<?= $listGuild['guild_img']; ?>"
        alt="">
      <div class="card-body">
        <h3 class="card-title bg-gradient rounded shadow p-3 text-dark text-uppercase small font-weight-bold">
          <?= $listGuild['guild_name'] ?></h3>
        <?php if($listGuild['guild_aktif'] < 1): ?>

        <p class="small">
          <span class="badge badge-danger">Server Blocked</span>
        </p>

        <?php endif ?>
        <p class="card-text"><?= $listGuild['guild_info'] ?></p>
      </div>
      <div class="card-footer">
        <a href="?mod=editData&data=<?= base64_encode($listGuild['id_guild']); ?>" class="btn btn-info btn-sm">
          <i class="fas fa-edit fa-fw"></i> Edit
        </a>
        <a href="?mod=deleteGuildFromlist&data-guild=<?= base64_encode($listGuild['id_guild']); ?>"
          class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin')">
          <i class="fas fa-trash-alt fa-fw"></i> Delete
        </a>

      </div>
      <div class="card-footer">
        <?php if($listGuild['guild_post'] === 'Public'): ?>
        <p class="small">Akses Guild ::
          <span class="badge badge-primary">
            <i class="fa fa-globe fa-fw" aria-hidden="true"></i> <?= $listGuild['guild_post']; ?>
          </span>
        </p>
        <p>Creator :: <a href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($listGuild['full_name']) ?>"
            class="btn btn-link"><?= $listGuild['full_name']; ?></a></p>

        <?php elseif($listGuild['guild_post'] === 'Private'): ?>
        <p class="small">Akses Guild ::
          <span class="badge badge-dark">
            <i class="fas fa-lock fa-fw"></i> <?= $listGuild['guild_post']; ?>
          </span>
        </p>
        <p>Creator :: <a
            href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($listGuild['full_name']) ?>"><?= $listGuild['full_name']; ?></a>
        </p>

        <?php endif ?>
      </div>
    </div>
  </div>
  <?php endforeach ?>
</div>