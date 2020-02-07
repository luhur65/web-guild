<?php 

// Ambil Data Param
$id = base64_decode($_GET['data']);

// Query data Berdasarkan Param
$queryData = "SELECT * FROM report_user JOIN report_type ON report_user.id_type = report_type.id_type JOIN object_report ON report_type.object_report = object_report.id_object JOIN guild_info_member ON guild_info_member.id_user = report_user.from_user WHERE id_report = '$id'";

$viewData = mysqli_query($conn,$queryData);

$dt = mysqli_fetch_assoc($viewData);

if ($dt['id_report'] !== $id) {
    echo showMessage('danger','404 Not Found!','Report User Tidak Dapat Ditemukan , Periksa Ulang Kembali!');
}


// Jika Di Tekan Tombol Send Feedback
    // Kirim Balasan Report
    if (isset($_POST['reply'])) {
        if (feedbackReport($_POST) > 0) {
           $success = true;
        } else {
            $failed = true;
        }
    }

?>

<?php foreach($viewData as $rp) : ?>

<div class="card shadow h-100 py-2 my-4 col-md-7 mx-auto rounded">
    <div class="card-header shadow p-4 rounded bg-info d-flex flex-row align-items-center justify-content-between">
    <a href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($rp['full_name']) ?>">
        <img src="<?= base_url; ?>/assets/img/user-icon/<?= $rp['foto_profil']; ?>" alt="Profil" class="img-fluid img-anggota rounded-circle">
        <span class="text-white"><?= $rp['full_name']; ?></span>
    </a>
        <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <?php if($rp['is_receive'] === '0') :?>
            <a class="dropdown-item text-info" href="#" data-toggle="modal" data-target="#feedbackModal"><i class="fas fa-paper-plane fa-fw"></i> Kirim Balasan</a>
            <?php elseif($rp['is_receive'] === '1') :?>
            <a class="dropdown-item text-info disabled" href="#" data-toggle="modal" data-target="#feedbackModal"><i class="fas fa-paper-plane fa-fw"></i> Kirim Balasan</a>
            <?php endif ?>
        </div>
        </div>
    </div>
    <div class="card-body">

    <?php if(isset($success)) :?>
    <?= showMessage('success','Berhasil Terkirim!','Feedback Anda Telah Dikirim!') ?>
    <?php elseif(isset($failed)) : ?>
    <?= showMessage('danger','Gagal Terkirim!','Feedback Anda Tidak Bisa Dikirim!') ?>
    <?php endif ?>

        <h3 class="text-primary mb-3">Report Detail</h3>
        <div>
            <p class="text-dark">1.Object Permasalahan</p>
            <ul class="card p-2 col-lg-6 text-center">
                <span class="text-danger text-uppercase"><?= $rp['isi']; ?></span>
            </ul>
        </div>
        <div>
            <p class="text-dark">2.Kategori Permasalahan</p>
            <ul class="card p-2 col-lg-6 text-center">
                <span class="text-danger text-uppercase"><?= $rp['type']; ?></span>
            </ul>
        </div>
        <label for="text" class="text-dark">3.Deskripsi Tambahan</label>
            <div class="form-group">
                <textarea class="form-control text-danger" name="text" id="text" rows="4" readonly><?= $rp['detail_report']; ?></textarea>
            </div>

        <?php 

        $tersangka = $rp['reported_user'];
        $idReport = $rp['id_report'];
        
        // Data Kepada
        $dataSuspect = "SELECT * FROM guild_info_member JOIN report_user ON report_user.reported_user = guild_info_member.id_user WHERE reported_user = '$tersangka' And id_report = '$idReport'";

        $view = query($dataSuspect);
        
        ?>
        <?php foreach($view as $sv) : ?>
        
        <div>
            <p>Report Ini Ditujukan Kepada</p>
            <span>
            <img src="<?= base_url; ?>/assets/img/user-icon/<?= $sv['foto_profil']; ?>" alt="Profil" class="img-fluid img-anggota rounded-circle">
            <a href="<?= base_url; ?>/attr/User/?mod=viewUser&q=<?= base64_encode($sv['full_name']) ?>">
            <span class="text-dark"><?= $sv['full_name']; ?></span>
             </a>
            </span>
        </div>

        <?php endforeach; ?>
        <a href="?mod=viewListReport" class="btn btn-outline-danger mt-3 float-right">Back To List Report</a>
    </div>
</div>

<?php endforeach ?>


<!-- Modal Balas Report-->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Feedback Report</h5>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <input type="hidden" name="idReport" value="<?= $dt['id_report'] ?>" readonly>
                <input type="hidden" name="userSend" value="<?= $dt['from_user'] ?>" readonly>
                    <div class="form-group">
                      <label for="feedback">Your Feedback</label>
                      <textarea class="form-control" name="feedback" id="feedback" rows="4" required></textarea>
                    </div>
                <button type="submit" class="btn btn-primary" name="reply">Send FeedBack!</button>
                </form>
            </div>
        </div>
    </div>
</div>
