<div class="card col-lg shadow mx-auto">
    <div class="card-body">

    <div class="alert alert-primary" role="alert">
    <p class="mb-0"> <span class="font-weight-bold">Note:</span> Logging Terbaru Dilihat Dari Bawah!!</p>
    </div>

    <?php 

    // Membuka file log
    $file = file('../log.txt');

    // count log 
    $countLog = count($file);

    // jika Kurang dari satu logging
    if($countLog <= 0) {
        echo '<h3>[ Data Log Activity Masih Kosong! ]</h3>';
    } elseif ($countLog >= 99) {
        // jika melebihi 99 baris maka hapus 
        unlink('../log.txt');
    }

    // Buat Tabel Untuk Masing Masing Postingan
    for ($index=0; $index < $countLog; $index++) {

        // pecah setiap bagian array
        $bagian = explode(' ### ', $file[$index]);

        // mengambil data user yg ada di database berdasarkan username login
        $user = $bagian[2];
        
        $infoUser = "SELECT * FROM guild_info_member WHERE username = '$user' or email = '$user'";
        $infoQueryUser = mysqli_query($conn, $infoUser);
        $usr = mysqli_fetch_assoc($infoQueryUser);

        echo '<div class="row">
        <div class="col-lg mb-2">
        <div id="accordianId'. $index .'" role="tablist" aria-multiselectable="true">
        <div class="card shadow rounded">
            <div class="card-header" role="tab" id="section1HeaderId'. $index .'">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordianId'. $index .'" href="#section1ContentId'. $index .'" aria-expanded="true" aria-controls="section1ContentId'. $index .'">
                    '. $index .'. '.$usr['full_name'].' '.$bagian[0].'
            </a>
                </h5>
            </div>
            <div id="section1ContentId'. $index .'" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId'. $index .'">
                <div class="card-body">
                <div class="col-lg mt-2">
                    <dl class="row">
                        <dt class="col-sm-4">Tanggal</dt>
                        <dd class="col-sm-8">'. $bagian[0] .'</dd>
                        <dt class="col-sm-4">Waktu</dt>
                        <dd class="col-sm-8">'. $bagian[1] .'</dd>
                        <dt class="col-sm-4">Access</dt>
                        <dd class="col-sm-8">'. $_SERVER['HTTP_USER_AGENT'] .' </dd>
                        <dt class="col-sm-4">Alamat IP</dt>
                        <dd class="col-sm-8">'. $_SERVER['REMOTE_ADDR'] .' </dd>
                        <dt class="col-sm-4">User</dt>
                        <dd class="col-sm-8"><img src="'. base_url .'/assets/img/user-icon/'. $usr['foto_profil'] .'" class="img-fluid img-anggota mr-1" alt="">'. $usr['full_name'] .'</dd>
                        <dt class="col-sm-4">Info</dt>
                        <dd class="col-sm-8">'. $bagian[3] .'</dd>
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8"><span class="badge badge-success p-2">'. $bagian[4] .'</span></dd>
                    </dl>
                
            </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>'; 

     }
    
    ?>

    </div>
</div>