<?php

$id = base64_decode($_GET['guild']);

$checkGuild = "SELECT * FROM guild_center JOIN guild_info_member ON guild_info_member.guild_id = guild_center.id_guild WHERE guild_info_member.guild_id = '$id'";

$queryCheck = query($checkGuild);

foreach ($queryCheck as $gl) {
	
	// Jika Guild Di block oleh Admin
	if ($gl['guild_aktif'] < 1) {
    	echo showMessage('danger','Blocked','Kami Memblokir Guild Ini Untuk Sementara Waktu Sampai Masa Waktu Yg Telah Kami Tentukan Sendiri!!, Terima Kasih');

    	return false;
	}
}

// Cek Jika Ada Anggota atau orang lain
// masuk ke guild tanpa join
if ($detail['guild_id'] !== $id) {
    echo alertPopUp('Anda Bukan Anggota Guild Ini', '?mod=home');

    return false;
}

?>

<?php if ($detail['guild_id'] === $id)  : ?>


<!-- Chatting -->
<script src="<?= base_url; ?>/attr/User/messages/jquery.min.js"></script>
<script src="<?= base_url; ?>/attr/User/messages/client.js"></script>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Guild Chatting</h1>
	<span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>

<div class="row">

	<div class="col-lg mb-4">
		<div class="card shadow p-2 rounded" aria-hidden="true">
			<div class="card-body" id="response">


			</div>
		</div>

		<div class="form-group mb-0 mt-2 shadow card">
			<form method="post" class="p-3">
				<div class="form-group">
					<img src="<?= base_url; ?>/assets/img/user-icon/<?= $detail['foto_profil'];?>"
						class="img-fluid img-anggota rounded-circle" alt="Profil"> <?= $detail['full_name']; ?>
				</div>
				<input type="hidden" name="name" id="name" placeholder="Your name here"
					value="<?= $detail['full_name']; ?>"
					readonly required />
				<input type="text" name="message" id="message" placeholder="Type message here" class="form-control"
					required />
			</form>
		</div>
	</div>

	<div class="col-lg-3">

		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Member Guild</h4>
				<?php foreach ($queryCheck as $ck) : ?>
				<div class="mt-3">
					<img src="<?= base_url; ?>/assets/img/user-icon/<?= $ck['foto_profil'];?>"
						class="img-fluid img-thumbnail rounded-circle" alt="4das7657a23has81hsjc">
					<?= $ck['full_name']; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>

	</div>

</div>


<?php endif; ?>
