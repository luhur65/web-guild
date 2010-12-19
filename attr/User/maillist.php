<?php 

$id = $detail['id_user'];

// mail 
$dataMail = "SELECT * FROM guild_chat INNER JOIN guild_info_member ON guild_info_member.id_user = guild_chat.to_user JOIN guild_center On guild_chat.guild_id = guild_center.id_guild WHERE guild_chat.to_user = '$id' Order By id_invite DESC";
$queryMail = query($dataMail);

$banyakMail = count($queryMail);

?>

<div class="row">
    <div class="card col-lg-7">
        <div class="card-body">
            <h3 class="p-2 rounded text-dark">
                <i class="fa fa-envelope fa-fw text-primary" aria-hidden="true"></i> 
                Mail Message
            </h3>
            <hr class="divider bg-dark"> 
            <div class="alert alert-info" role="alert">
                <span class="font-weight-bold">Note :</span>
                <p class="mb-0"> Ini Tempat Dimana Kamu Menerima Pesan & Menanggapinya !</p>
            </div>
            <?php if($banyakMail > 0 ) : ?>
                <?php foreach($queryMail as $m) : ?>
                    <?php if($m['accept'] < 1) : ?>
                        <a class="dropdown-item d-flex align-items-center p-2 mt-2" href="?mod=readMail&data=<?= $m['id_invite']; ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-users fa-fw text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">-- Invitation To Join Guild --</div>
                                <div class="text-truncate font-weight-bold">
                                    <?= substr(base64_decode($m['pesan_invite']),0,28); ?>...</div>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php else : ?>
                    <div class="mx-auto text-center mt-5">
                        <i class="fas fa-smile-wink fa-fw fa-10x text-primary"></i>
                        <p class="display-4 font-weight-bold">No Message!</p>
                    </div>
            <?php endif; ?>
        </div>
    </div>
</div>