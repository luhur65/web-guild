<?php 

// decode url dulu
$id = base64_decode($_GET['data']);

// Ambil Data Dari Database
$dataNotif = "SELECT * FROM feedback WHERE id_feedback = '$id'";
$queryDataNotif = mysqli_query($conn,$dataNotif);

// Ambil Semua Isi Dari Array Data
$on = mysqli_fetch_assoc($queryDataNotif);

// Pengecekan Data 
if ($on['id_feedback'] !== $id) {
    echo showMessage('danger','404 Not Found','Data Pesan Notifikasi Anda Tidak Dapat Ditemukan , Mohon Coba Lagi ');

    return false;

} elseif($on['id_feedback'] === $id) {
    
    // Update Table feedback 
    // column " is_read"

    $read = 1;
    mysqli_query($conn, "UPDATE `feedback` SET `is_read`= '$read' WHERE id_feedback = '$id'");
}

?>

<div class="card col-lg-6 mx-auto my-5 shadow rounded p-4">
    <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
    <div class="card-body">
        <?php foreach($queryDataNotif as $ada) : ?>
        <h4 class="card-title text-center bg-info text-white rounded p-3">FeedBack Laporan Anda</h4>
        <hr class="bg-dark">
            <div class="mt-4 mx-auto">
            <div class="alert alert-success" role="alert">
              <p class="text-center p-3"><?= $ada['feedback']; ?></p>
              <a href="?mod=home" class="btn btn-primary">
                Back To Home
            </a>
            </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
