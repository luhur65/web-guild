<?php 

// Ambil Data 
$id = $_GET['data'];

$dataReport = "SELECT * FROM report_guild JOIN guild_center ON report_guild.guild_report = guild_center.id_guild JOIN guild_info_member ON guild_info_member.id_user = report_guild.user_report WHERE id_report_guild = '$id'";

$queryReport = query($dataReport);

?> 


<div class="card col-lg-6">
    <div class="card-body">
        <?php foreach($queryReport as $r)  :?>

            <div class="form-group">
              <label for="">Report is Sent By :  
                <a href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($r['full_name']) ?>"><?= $r['full_name']; ?></a>
                </label>
              <textarea class="form-control bg-white text-dark mt-3" rows="6" readonly><?= $r['report_teks']; ?></textarea>
            </div>

            <a href="?mod=guildCase" class="btn btn-link ">&larr; Kembali Ke List Page</a>

        <?php endforeach; ?>
    </div>
</div>