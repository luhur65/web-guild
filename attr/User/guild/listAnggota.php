<?php 

// Params Url
$guild = htmlspecialchars(base64_decode($_GET['data']),ENT_QUOTES);

$list = "SELECT * FROM guild_center JOIN guild_info_member ON guild_info_member.guild_id = guild_center.id_guild WHERE id_guild = '$guild'";
$queryList = query($list);

?>

<div class="card shadow rounded p-3 col-lg-5">
    <div class="card-body">
        <h3 class="mb-3 h3 text-dark">All Member</h3>
        <?php foreach($queryList as $l) : ?>
            <?php if($l['foto_profil'] > 0) :?>
                <a href="?mod=viewUser&q=<?= base64_encode($l['full_name'])?>" class="text-dark">
                <p class="d-block">
                <img src="<?= base_url; ?>/assets/img/user-icon/<?= $l['foto_profil']; ?>"
                    class="img-thumbnail img-fluid rounded-circle" alt=""> 
                    <?= $l['full_name']; ?>
                </p>
                </a>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
</div>