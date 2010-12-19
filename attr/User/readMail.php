<?php

$id = $_GET['data'];

// Data Email Pengirim
$pengirimMail = "SELECT * FROM guild_chat INNER JOIN guild_info_member ON guild_info_member.id_user = guild_chat.pengirim JOIN guild_center On guild_chat.guild_id = guild_center.id_guild WHERE guild_chat.id_invite = '$id'";
$queryPengirim = query($pengirimMail);


if (isset($_POST['yes'])) {

    if (joinToGuild($_POST) > 0) {
        
        $joinOk = true;
    
    } else {
        
            $joinNull = true;
    }

}

?>


<div class="card col-lg-6 mx-auto shadow">
    <div class="card-body">
        <?php foreach($queryPengirim as $sp) : ?>
        <img src="<?= base_url; ?>/assets/img/user-icon/<?= $sp['foto_profil']; ?>"
            class="img-fluid img-thumbnail rounded-circle" alt="<?= $sp['full_name']; ?>">
        <span class="text-dark mr-3"><?= $sp['full_name']; ?></span>
        <hr>

            <?php if(isset($emptyToken)) : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Token Kosong!</strong> Token guild Belum Anda Isi
            </div>div>
            <?php elseif(isset($joinNull)) : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Gagal Join!</strong> Ada Kesalahan , Coba Lagi Nanti!!
            </div>
            <?php elseif(isset($invalidToken)) : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Token Salah!</strong> Token guild Yang Anda Isi Salah , Periksa !!
            </div>
            <?php elseif(isset($joinOk)) : ?>
            <?= showMessage('success','Berhasil Join!','Selamat Anda Sekarang Telah Bergabung'); ?>
            <?php endif; ?>
            
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Invitation Join Guild</h4>
            <p class="p-3 text-center">
                <?= base64_decode($sp['pesan_invite']); ?>
            </p>
            <!-- <p class="mt-3 p-3">
                 Token guild = <?= base64_decode($sp['guild_pass']); ?>
                </p>
            <span class="mt-4 text-danger mb-0">Nb : Token Dipakai Untuk Join</span> -->
        </div>
        
            <form action="" method="post">
            <input type="hidden" name="idUserToJoin" value="<?= $detail['id_user'];?>" readonly>
            <input type="hidden" name="indexGuildId" value="<?= $sp['guild_id'] ?>" readonly>
            <!-- <div class="form-group mb-2">
              <input type="text" name="token" id="token" class="form-control" placeholder="Masukkan Token" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Nb : Masukkan Token Terlebih Dahulu</small>
            </div> -->
            <div class="form-group btn-group mt-3">
              <button type="submit" class="btn btn-success mr-2" name="yes"> Accept To Join </button>
              <button type="submit" class="btn btn-danger" name="no"> Reject To Join </button>
            </div>
            
            </form>
        <?php endforeach; ?>
    </div>
</div>