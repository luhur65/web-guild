<?php 

$id = base64_decode($_GET['user']);

// cek jika yg mengakses halaman ini bukan pemilik akun yg sebenarnya 
if($detail['id_user'] !== $id){
    echo "<script> document.location.href='?mod=home'; </script>";

    exit();
    return false;
} 

// jika ditekan tombol delete
if(isset($_POST['verify'])){

    $password = htmlspecialchars($_POST['passToVerify']);
    $confirmPass = htmlspecialchars($_POST['confirmPass']);

    // cek konfirmasi password
    if($password !== $confirmPass){
        echo alertPopUp('Konfirmasi Password Tidak Sesuai!', '?mod=delete&user='.$_GET['user'].'');

    }
    
    $query = "SELECT * FROM guild_info_member WHERE id_user = '$id'";
    $getQuery = mysqli_query($conn, $query);

    // jika ada 
    if (mysqli_num_rows($getQuery) === 1) {
        
        $row = mysqli_fetch_assoc($getQuery);
       
        // cek passwordnya 
        if(password_verify($password, $row['password'])) {
            
            // jika benar maka , hapus akun nya 
            if(hapusUser($id) > 0) {
                echo alertPopUp('Akun Berhasil Dihapus!', '../auth_out.php');
            } else {
                echo alertPopUp('Gagal Menghapus Akun!', '?mod=delete&user='.$_GET['user'].'');
            }

        } else {
            echo alertPopUp('Password Anda Salah!', '?mod=delete&user='.$_GET['user'].'');
        }
    }
}

?>

<div class="row">

    <div class="card col-lg-6 shadow">
        <div class="card-body">
            <h4 class="card-title"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Verify Password</h4>
            <hr>
            <div class="mt-4">

            <div class="alert alert-info" role="alert">
            <span class="font-weight-bold">Note :</span>
              <p class="mb-0">Untuk Memverifikasi jika benar ini anda , Harap Masukkan Passoword Anda!!</p>
            </div>

                <form action="" method="post">
    
                    <div class="form-group">
                        <label for="pass1">Password</label>
                        <input type="password" class="form-control" name="passToVerify" id="pass1" required>
                    </div>

                    <div class="form-group">
                        <label for="pass3">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="confirmPass" id="pass3" required>
                    </div>

                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="agree" id="agree" value="checkedValue" required>
                        <span class="text-primary">Saya Setuju bahwa akun saya akan dihapus & tidak  bisa dikembalikan lagi</span>
                      </label>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-outline-danger btn-block" name="verify">
                            Delete My Account
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>