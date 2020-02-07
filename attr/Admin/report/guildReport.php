<?php 

// Data List
$listReport = "SELECT * FROM report_guild JOIN guild_center On guild_center.id_guild = report_guild.guild_report JOIN guild_info_member ON guild_info_member.id_user = report_guild.user_report";

$queryListReport = query($listReport);
?>

<!-- Judul Halaman -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Reporting Of Guild</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">

<div class="card mx-auto col-lg-7 shadow">
<table class="table table-striped table-inverse table-responsive text-center p-3">
    <thead class="thead-inverse">
        <tr>
            <th>Banner Guild</th>
            <th>Nama Guild</th>
            <th>User Pelapor</th>
            <th>Aksi Hapus</th>           
            <th>Read More</th>           
        </tr>
        </thead>
        <tbody>
            <?php foreach($queryListReport as $l) :?>
            <tr>
                <td><img src="<?= base_url; ?>/assets/img/guild_img/<?= $l['guild_img']; ?>" class="img-fluid img-thumbnail" alt=""></td>
                <td><a href=""><?= $l['guild_name']; ?></a></td>
                <td><a href=""><?= $l['full_name']; ?></a></td>
                <td>
                    <a href="" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash fa-fw fa-2x"></i>
                    </a>
                </td>
                <td>
                    <a href="" class="btn btn-link">
                        <i class="fa fa-link fa-fw" aria-hidden="true"></i> Read More
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
</table>
</div>