<?php 

// Jika Tidak Ada Parameter Chat
if (!isset($_GET['chat'])) {
	echo '<script>document.location.href = "?mod=home"</script>';
} elseif (empty($_GET['chat'])) {
	echo '<script>document.location.href = "?mod=home"</script>';
} 

// Mengambil Data User Yg Ingin Dichat
$id = base64_decode($_GET['chat']);

$dataUserChat = "SELECT * FROM guild_info_member WHERE id_user = '$id'";
$queryChat = query($dataUserChat);

?>

<!-- Chatting -->
<script src="<?= base_url; ?>/attr/User/messages/jquery.min.js"></script>
<script src="<?= base_url; ?>/attr/User/messages/client.js"></script>

<?php foreach($queryChat as $qc) : ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Online Chatting</h1>
	<span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>

<div class="col-lg-7 mx-auto">
	<div class="card shadow p-2 rounded" aria-hidden="true">
		<div class="card-body" id="response">
		
			
		</div>
	</div>

	<div class="form-group mb-0 mt-2 shadow">
		<form method="post">
			<input type="hidden" name="name" id="name" placeholder="Your name here" value="<?= $detail['full_name']; ?>" readonly required />
			<input type="text" name="message" id="message" placeholder="Type message here" class="form-control mr-0" required />
		</form>
	</div>
</div>

<?php endforeach; ?>