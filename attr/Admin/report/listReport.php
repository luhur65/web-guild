<!-- Judul Halaman -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All List Report User</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">

<?php 

// Data Report Dari Database
$queryReport = "SELECT * FROM report_user JOIN report_type On report_user.id_type = report_type.id_type JOIN object_report ON report_type.object_report = object_report.id_object JOIN guild_info_member ON guild_info_member.id_user = report_user.from_user Order By id_report DESC";

$arrayReport = query($queryReport);

?>

<div class="row">
<!-- Jumlah List Report Yg Dikirim -->
<div class="card shadow h-100 py-2 my-4 col-md-6 mx-auto">
    <div class="card-body">
<table class="table table-hover table-inverse table-responsive text-center">
    <thead class="thead-inverse">
        <tr>
            <th>#No</th>
            <th>ProfilUser</th>
            <th>ActionConfirmation</th>
            <th>Delete</th>
            <th>ViewReport</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($arrayReport as $rp):?>
            <tr>
                <td><?= $i++; ?></td>
                <td>
                    <img src="<?= base_url; ?>/assets/img/user-icon/<?= $rp['foto_profil']; ?>" alt="Profil" class="img-fluid img-anggota rounded-circle">
                    <a href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($rp['full_name']) ?>"><span class="text-dark d-block"><?= $rp['full_name']; ?></span></a>
                </td>
                <td>
                    <?php if($rp['is_receive'] == '0') : ?>
                    <div class="small">
                    <span class="badge badge-danger text-lowercase">
                        <i class="fas fa-eye-slash fa-fw"></i> Is Waiting ...
                    </span> 
                    </div>
                    <?php elseif($rp['is_receive'] == '1'):?>
                    <div class="small">
                    <span class="badge badge-success">
                        <i class="fa fa-check fa-fw" aria-hidden="true"></i> Finished
                    </span>
                    </div>
                    <?php endif ?>
                </td>
                <td>
                <?php if($rp['is_receive'] == '0') : ?>
                <a href="?mod=deleteRp&data=<?= base64_encode($rp['from_user']); ?>" class="btn btn-danger btn-circle btn-sm disabled" onclick="return confirm('Anda Yakin Menghapus Laporan Ini Sebelum Anda Balas')">
                    <i class="fa fa-trash-alt" aria-hidden="true"></i>
                </a>
                <?php elseif($rp['is_receive'] == '1'):?>
                <a href="?mod=deleteRp&data=<?= base64_encode($rp['from_user']); ?>" class="btn btn-danger btn-circle btn-sm">
                    <i class="fa fa-trash-alt" aria-hidden="true"></i>
                </a>
                    <?php endif ?>
                </td>
                <td>
                    <a href="?mod=seeDetail&data=<?= base64_encode($rp['id_report']); ?>" class="btn btn-link btn-sm">
                        <i class="fa fa-link fa-fw" aria-hidden="true"></i> Read ...
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
</table>
    </div>
</div>
