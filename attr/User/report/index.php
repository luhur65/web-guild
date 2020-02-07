<?php

// Data di Url
$encodeUrl = $_GET['data'];

// decode
$urlData = base64_decode($encodeUrl);

// Query Data
$datauser = "SELECT * FROM guild_info_member WHERE full_name = '$urlData'";
$queryUser = mysqli_query($conn,$datauser);

$dt = mysqli_fetch_assoc($queryUser);

/**
 * Cek Jika User Yg Dilaporkan Tidak Ada
 */

 if ($urlData !== $dt['full_name']) {
     echo '<div class="alert alert-danger" role="alert">
       <h4 class="alert-heading display-3">404 Not Found</h4>
       <p>User Tidak Dapat Ditemukan . Periksa Koneksi Anda !!!</p>
       <p class="mb-0">
       <a href="'.base_url .'/attr/User/?mod=reportUser&data='. $_GET['data'] .'" class="font-italic small">
       '.base_url .'/attr/User/?mod=reportUser&data='. $_GET['data'] .'
       </a>
       </p>
     </div>';

     return false;
 } 

 ?>

 <?php

 // Jenis Reporting
 $dataJenis = "SELECT * FROM object_report";
 $queryJenis = query($dataJenis);

 ?>
<?php if($dt['id_user'] !== $detail['id_user']) :?>
 <div class="card col-lg-6 shadow p-2 mx-auto mb-5">
     <div class="card-body">
         <h2 class="card-title text-primary">Report Page</h2>
         <hr class="bg-secondary mb-5">

         <?php 
         
         if (isset($_POST['submitReport'])) {
             if (empty($_POST['typeMasalah']) || empty($_POST['detail'])) {
                 echo showMessage('danger','Data Kosong','Anda Belum Mengisi Semua Data');
             } else {
                 if (getReportSoon($_POST) > 0) {
                     echo showMessage('success','Berhasil!','Kami Akan Memproses Laporan Anda');
                 } else {
                     echo showMessage('danger','Gagal','Something Happen Wrong , Please Try Again!');
                 }
             }

         }
         
         ?>
         <div class="card mb-4 bg-light">
             <div class="card-body text-danger">
                 <img src="<?= base_url; ?>/assets/img/user-icon/<?= $dt['foto_profil'] ?>" class="img-fluid img-anggota rounded-circle" alt="Profil">
                 <?= $dt['full_name']; ?>
             </div>
         </div>
         <form action="" method="post">
             <input type="hidden" name="tersangka" value="<?= $dt['id_user'] ?>" readonly>
             <input type="hidden" name="pelapor" value="<?= $detail['id_user'] ?>" readonly>
            <label for="jenis" class="text-dark d-block">Pilih Kategori Report : </label>
            <?php $i = 1; ?>
            <?php foreach($queryJenis as $j): ?>
            <div class="form-group">
                <button type="submit" name="choose" value="<?= $j['id_object'] ?>" class="btn btn-link mr-3" id="jenis"><?= $i++; ?>.<?= $j['isi']; ?></button>
            </div>
            <?php endforeach ?>
            <?php if(isset($_POST['choose'])) : ?>
                <?php if($_POST['choose'] == '1'):?>
                <?php 
                
                // Reporting Type Masalah
                $dataType = "SELECT * FROM report_type JOIN object_report ON report_type.object_report = object_report.id_object WHERE object_report = 1";
                
                $queryTipe = query($dataType);
                
                ?>
                <p class="text-dark mb-1">Pilih Masalah Laporan :</p>
                <?php foreach($queryTipe as $t) : ?>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="typeMasalah" id="" value="<?= $t['id_type']?>">
                        <?= $t['type']; ?>
                      </label>
                    </div>
                <?php endforeach ?>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="detail" id="detail" rows="4" placeholder="Deksripsikan Lebih Jelas Masalah Anda !!"></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" name="submitReport" class="btn btn-primary">
                      Kirim Report Saya!
                  </button>
                </div>
                <?php endif ?>
                <?php if($_POST['choose'] == '2'):?>
                <?php 
                
                // Reporting Type Masalah
                $dataType = "SELECT * FROM report_type JOIN object_report ON report_type.object_report = object_report.id_object WHERE object_report = 2";
                
                $queryTipe = query($dataType);
                
                ?>
                <p class="text-dark mb-1">Pilih Masalah Laporan :</p>
                <?php foreach($queryTipe as $t) : ?>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="typeMasalah" id="" value="<?= $t['id_type']?>">
                        <?= $t['type']; ?>
                      </label>
                    </div>
                <?php endforeach ?>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="detail" id="detail" rows="4" placeholder="Deksripsikan Lebih Jelas Masalah Anda !!"></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" name="submitReport" class="btn btn-primary">
                      Kirim Report Saya!
                  </button>
                </div>
                <?php endif ?>
            <?php endif ?>
         </form>
     </div>
 </div>

 <?php else : ?>

         <div class="alert alert-danger" role="alert">
             <strong>Warning!</strong>
                Anda Tidak Bisa Melaporkan Diri Anda Sendiri!
             <a href="?mod=home" class="btn btn-primary d-block col-lg-2 mt-4">
                 Back To Dashboard
             </a>
         </div>

<?php endif; ?>