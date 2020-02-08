<?php 

$id = $_GET['data'];

// Data Email Penerima
$penerimaMail = "SELECT * FROM guild_chat INNER JOIN guild_info_member ON guild_info_member.id_user = guild_chat.to_user JOIN guild_center On guild_chat.guild_id = guild_center.id_guild WHERE guild_chat.id_invite = '$id'";
$queryPenerima = query($penerimaMail);

// Data Email Pengirim
$pengirimMail = "SELECT * FROM guild_chat INNER JOIN guild_info_member ON guild_info_member.id_user = guild_chat.pengirim JOIN guild_center On guild_chat.guild_id = guild_center.id_guild WHERE guild_chat.id_invite = '$id'";
$queryPengirim = query($pengirimMail);
