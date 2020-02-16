<?php 

// Id user yg ingin dichat
$id = base64_decode($_GET['data']);

// Id user yg menerima chatting
$penerima = $detail['id_user'];

// chatting Pengirim
$queryPengirim = "SELECT * FROM user_chat JOIN guild_info_member ON user_chat.dari_user = guild_info_member.id_user WHERE dari_user = '$id'";
$sendBy = mysqli_query($conn,$queryPengirim);


// Mengirim Pesan
if (isset($_POST['chat'])) {
    
    if (replyChat($_POST) > 0) {
       
        $idUser = base64_encode($id);
        echo '<script>document.location.href = "?mod=mail&data='. $idUser .'"</script>';
    } else {
        echo alertPopUp('Gagal Mengirim','?mod=home');
    }
}


?>

<div class="col-lg-7">
    <div class="card mb-0">
        <div class="card-body">
            <!-- Isi Chatting -->
            <?php foreach($sendBy as $Sb) : ?>

            <!-- Chatting si Pengirim -->
            <div class="media mb-3">
                <!-- <img class="d-flex mr-2 rounded-circle" src="http://placehold.it/50x50" alt=""> -->
                <div class="media-body">
                    <h5 class="mt-0 text-danger"><?= $Sb['full_name']; ?></h5>
                    <p class="alert alert-dark"><?= base64_decode($Sb['isi_chat']); ?>.</p>

                    <?php 

                    $idchat = $Sb['no_chat'];

                    // Chatting penerima
                    $queryChatting = "SELECT * FROM reply_user_chat JOIN guild_info_member ON reply_user_chat.penerima = guild_info_member.id_user WHERE id_chat = '$idchat'";
                    $chatWithMe = query($queryChatting);

                    ?>

                <!-- Balasan Chatting -->
                <?php foreach($chatWithMe as $Cm) : ?>
                    <div class="media mt-4 text-right">
                        <div class="media-body">
                            <h5 class="mt-0 text-primary"><?= $Cm['full_name']; ?></h5>
                            <p class="alert alert-primary"><?= base64_decode($Cm['reply_isi_chat']); ?>.</p>
                        </div>
                    <!-- <img class="d-flex mr-3 mx-2 rounded-circle" src="http://placehold.it/50x50" alt=""> -->
                    </div>
                <?php endforeach; ?>
                </div>
            </div>

            <?php endforeach; ?>
        </div>

    </div>

    <!-- Inputtan Chatting / text -->
    <form action="" method="post">
        <div class="form-group mt-1">
        <input type="hidden" name="idChat" value="<?= $idchat ?>" readonly>
        <input type="hidden" name="sender" value="<?= $detail['id_user']; ?>" readonly>
            <input type="text" name="chat" id="text" class="form-control" placeholder="" required autofocus>
        </div>
    </form>
</div>