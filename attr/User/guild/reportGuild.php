<?php 

$id = base64_decode($_GET['guild']);

// Jika Tombol kirim diklik
if (isset($_POST['sendReport'])) {
    
    if (reportGuild($_POST) > 0) {
        echo alertPopUp('Berhasil Mengirim','?mod=home');
    } else {
        echo alertPopUp('Gagal Terkirim','?mod=home');
    }
}

?>
<div class="card mx-auto p-3">
    <div class="card-header bg-white">
        <h2 class="card-title">Report Guild</h2>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="user" value="<?= $detail['id_user']; ?>">
            <div class="form-group">
                <textarea class="form-control" name="info" rows="6" placeholder="Tulis Laporan Disini"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="sendReport">
                    <i class="fas fa-paper-plane fa-fw"></i> Send My Report
                </button>
            </div>
        </form>
    </div>
</div>