<?php 

$id = $detail['id_user'];

// mail 
$dataMail = "SELECT * FROM guild_chat INNER JOIN guild_info_member ON guild_info_member.id_user = guild_chat.to_user JOIN guild_center On guild_chat.guild_id = guild_center.id_guild WHERE guild_chat.to_user = '$id' Order By id_invite DESC";
$queryMail = query($dataMail);

?>

<div class="card col-lg-5 mx-auto">
    <div class="card-body">
        <?php foreach($queryMail as $m) : ?>
            <?php if($m['accept'] < 1) : ?>
        <a class="dropdown-item d-flex align-items-center p-2" href="?mod=readMail&data=<?= $m['id_invite']; ?>">
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    <i class="fas fa-users fa-fw text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">-- Invitation To Join Guild --</div>
                <div class="text-truncate font-weight-bold"><?= substr(base64_decode($m['pesan_invite']),0,28); ?>...</div>
            </div>
        </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>