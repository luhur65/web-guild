<?php 

// Link Utama
define('base_url',"http://localhost/tugasphp/guild");

// Konekesi Ke Database 
$hostname = 'localhost';
$username = 'root';
$pass = '';
$dbname = 'guild';

$conn = mysqli_connect($hostname,$username,$pass,$dbname);

// Function Query Database
function query($query) {

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Function Daftar Akun 
function daftarAkunBaru($data)
{
    global $conn;

    $namaLengkap = htmlspecialchars($data['FullName']); // Nama Lengkap
    $username = htmlspecialchars(strtolower(stripslashes($data['username']))); // Username
    $email = addslashes(stripslashes(strip_tags($data['InputEmail']))); // Email User
    $password1 = mysqli_real_escape_string($conn, $data['main_pass']); // Password Utama
    $password2 = mysqli_real_escape_string($conn, $data['RepeatPassword']); // Konfirmasi Password
    $join = date("Y-m-d"); // Tgl Hari Ini
    $role_id = 2; // Role ' user '
    $aktif = 1; // Nilai Aktif
    $profil = '';
    $gender = $data['gender'];
    $tglLahir = htmlspecialchars($data['tglLahir']);

    // Cek Username 
    // Sudah Ada Atau Belum ???
    $resultUsername = mysqli_query($conn, "SELECT * FROM guild_info_member WHERE username = '$username'");

    if (mysqli_fetch_assoc($resultUsername) > 0 ) {
        echo "<script>alert('username Sudah Terdaftar , Buat Username Yg Lain')</script>";
        echo mysqli_error($conn);
        return false;
    }

    // Cek Email
    // Sudah Ada Atau Belum ???
    $resultEmail = mysqli_query($conn, "SELECT * FROM guild_info_member WHERE email = '$email'");

    if (mysqli_fetch_assoc($resultEmail) > 0 ) {
        echo "<script>alert('Email Sudah Terdaftar , Buat Email Yg Lain')</script>";
        echo mysqli_error($conn);
        return false;
    }

    // Cek Password 
    // Apakah Sama 
    if ($password1 != $password2) {
        echo "<script>alert('Password Tidak Sesuai ')</script>";

        return false;
    }


    // Jika Semua Syarat Diatas Terpenuhi
    // Enkrypsikan Password  
    $password1 = password_hash($data['main_pass'],PASSWORD_DEFAULT);

     // menambahkan user ke database
     mysqli_query($conn,"INSERT INTO guild_info_member VALUES (null,'$namaLengkap','$username','$password1','$role_id','$email','','$profil','$join','$aktif','','$gender','$tglLahir')");

     return mysqli_affected_rows($conn);

}

// Function Message
function showMessage($tipe,$aksi,$datapesan)
{
    $message = '<div class="alert alert-'. $tipe .' alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>'. $aksi .'!</strong> '. $datapesan .'.
    </div>';

    return $message;
}

// Function Field Kosong
function alertPopUp($data,$tujuan)
{
    $alert = "<script>
                alert('".$data."');
                document.location.href = '".$tujuan."'
            </script>";

    // echo $alert;
    return $alert;
}

// function upload gambar userEdit User
function uploadProfilUser() {

    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar diupload

    if ($error === 4) {
        echo alertPopUp('Berhasil Memperbaharui Profil',''. base_url .'/attr/login');
        return false;
    } 

    // cek apakah yg diupload adalah gambar

    $ekstensiGambarValid = ['png', 'jpg', 'jpeg', 'gif'];
    $ekstensiGambar      = explode('.', $namaFile);
    $ekstensiGambar      = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo alertPopUp('Anda Bukan Mengupload Gambar',''. base_url .'/attr/login');

        return false;
    }
    // cek jika ukurannya besar

    if ($ukuranFile > 1000000) {
        echo alertPopUp('Ukuran Gambar Terlalu Besar',''. base_url .'/attr/login');
    }

    // lolos pengecekan gambar siap di upload

    // generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../../assets/img/user-icon/' . $namaFileBaru);

    return $namaFileBaru;
}

// Function Edit Profile
function editProfil($data)
{
    global $conn;

    $userID = $data['id'];
    $namaLengkap = htmlspecialchars($data['full_name'],ENT_QUOTES);
    $bioAkun = htmlspecialchars(stripslashes($data['bio']),ENT_QUOTES);
    $gambarLama = $data['gambarLama'];

    global $gambar;

    $gambar = uploadProfilUser();

     // bagian upload icon profil
     if (!($gambar)) {

        $query = "UPDATE guild_info_member SET
                    full_name = '$namaLengkap',
                    biografi = '$bioAkun',
                    foto_profil = '$gambarLama'
                    WHERE id_user = $userID
                        ";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);

     } 
    
     if ($gambar) {

        if ($gambar != $gambarLama) {
            
            global $conn;

            $pilih      = mysqli_query($conn, "SELECT * FROM guild_info_member WHERE id_user ='$userID'");
            $result     = mysqli_fetch_assoc($pilih);
            $dataGambar = $result['foto_profil'];
            unlink('../../assets/img/user-icon/' . $dataGambar);

            $query = "UPDATE guild_info_member SET
                    full_name = '$namaLengkap',
                    biografi = '$bioAkun',
                    foto_profil = '$gambar'
                    WHERE id_user = $userID
                        ";
        
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
         
        }
         
     } 

}

// Function Tambah Menu
function tambahMenu($data)
{
    global $conn;

    $nama = htmlspecialchars(strip_tags($data['name']));

    mysqli_query($conn,"INSERT INTO `menu`(`id_menu`, `menu`) VALUES (null,'$nama')");

    return mysqli_affected_rows($conn);
}


// Function Tambah Submenu Baru
function tambahSubmenu($data)
{
    global $conn;

    $title = htmlspecialchars($data['title']);
    $url = htmlspecialchars(strip_tags($data['url']));
    $icon = htmlspecialchars(strtolower($data['icon']));
    $active = $data['active'];
    $menu = $data['menuId'];

    mysqli_query($conn,"INSERT INTO `sub_menu`(`id`, `menu_id`, `title`, `url`, `is_aktif`, `icon`) VALUES (null,$menu,'$title','$url',$active,'$icon')");

    return mysqli_affected_rows($conn);

}

// Function Menonaktifkan Submenu
function disabled($data)
{
    global $conn;

    $active = 0;
    $id = $_GET['block'];

    $query = "UPDATE sub_menu SET is_aktif = '$active' WHERE id = '$id'";

    mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
}
// Function Mengaktifkan Submenu
function enable($data)
{
    global $conn;

    $active = 1;
    $id = $_GET['active'];

    $query = "UPDATE sub_menu SET is_aktif = '$active' WHERE id = '$id'";

    mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
}

// function upload gambar userEdit User
function bannerGuild() {

    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar diupload

    if ($error === 4) {
        echo alertPopUp('Berhasil Memperbaharui Data',''. base_url .'/attr/login');
        return false;
    } 

    // cek apakah yg diupload adalah gambar

    $ekstensiGambarValid = ['png', 'jpg', 'jpeg', 'gif'];
    $ekstensiGambar      = explode('.', $namaFile);
    $ekstensiGambar      = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo alertPopUp('Anda Bukan Mengupload Gambar',''. base_url .'/attr/login');

        return false;
    }
    // cek jika ukurannya besar

    if ($ukuranFile > 1000000) {
        echo alertPopUp('Ukuran Gambar Terlalu Besar',''. base_url .'/attr/login');

        return false;
    }

    // lolos pengecekan gambar siap di upload

    // generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../../assets/img/guild_img/' . $namaFileBaru);

    return $namaFileBaru;
}

// Function Create New Guild For User
function newGuild($data)
{
    global $conn;

    $nama= htmlspecialchars(strip_tags(addslashes(stripslashes($data['guildName']))),ENT_QUOTES);
    $teks= htmlspecialchars(strip_tags(addslashes(stripslashes($data['info']))),ENT_QUOTES);
    $creator= $data['creator'];
    $aktif = 1;
    $share = $data['share'];
    // Banner For Guild
    $banner = bannerGuild();

    mysqli_query($conn,"INSERT INTO `guild_center`(`id_guild`, `guild_name`, `guild_server`, `guild_info`, `guild_aktif`, `guild_img`, `guild_post`, `creator`, `guild_pass`) VALUES (null,'$nama','','$teks','$aktif','$banner','$share','$creator','')");

    $result =  mysqli_affected_rows($conn);


    if ($result > 0) {
        
        $data = "SELECT * FROM guild_center WHERE creator = '$creator'";
        $query = query($data);

        foreach ($query as $g) {

            // Join Langsung
            $idguild = $g['id_guild']; 
        }
        
            $join = "UPDATE guild_info_member SET guild_id = '$idguild' WHERE id_user = $creator";

            mysqli_query($conn,$join);

            return mysqli_affected_rows($conn);
    }

}

// Function Buat PAssword Jika Guildnya Adalah Private
function setPassword($data)
{
    global $conn;

    // Set password Untuk Guild Private
    $id = base64_decode($_GET['data']);

    $pass = htmlspecialchars($data['pass'],ENT_QUOTES);
    $confirm = htmlspecialchars($data['pass2'], ENT_QUOTES);


    // Enkrysip Password 
    $password = base64_encode($pass);

    mysqli_query($conn, "UPDATE `guild_center` SET `guild_pass`= '$password' WHERE id_guild = '$id'");

    return mysqli_affected_rows($conn);

}

// Function Join Guid
function joinToGuild($data)
{
    global $conn;

    $id_guild = $data['indexGuildId'];
    $id_user  = $data['idUserToJoin'];

    $query = "UPDATE guild_info_member SET guild_id = '$id_guild' WHERE id_user = $id_user";
        
        mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

// Function Delete Invitation
function ignoreInvite($data)
{
    global $conn;

    $idPesan = $data['idPesan'];

    mysqli_query($conn, "DELETE FROM `guild_chat` WHERE id_invite = $idPesan");

    return mysqli_affected_rows($conn);
    
}

// Function Undang Teman
function inviteFriend($data)
{
    $id = 0;
    $query = "SELECT * FROM guild_info_member WHERE
                            id_user LIKE '%$data%' OR
                            full_name LIKE '%$data%' OR 
                            username LIKE '%$data%' OR
                            email LIKE '%$data%'
                        ";

        return query($query);
}

// Function Menonaktifkan Submenu
function getOutFromGuild($data)
{
    global $conn;

    $guild = 0;
    $id = $_GET['user'];

    $query = "UPDATE guild_info_member SET guild_id = '$guild' WHERE id_user = '$id'";

    // Hapus Semua Postingan Yg Pernah Dibuat 
    mysqli_query($conn,"DELETE FROM guild_post WHERE guild_post.user_id = '$id'");

    mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
}

// Edit Guild Data
function editAllData($data)
{
    global $conn;

    $id = base64_decode($_GET['data']);

    // Data Guild
    $nama= htmlspecialchars(strip_tags(addslashes(stripslashes($data['nama']))),ENT_QUOTES);
    $teks= htmlspecialchars(strip_tags(addslashes(stripslashes($data['info']))),ENT_QUOTES);
    $share = $data['share'];

    $bannerLama = $data['bannerLama'];

    $bannerBaru = bannerGuild();

    // bagian upload icon profil
    if (!($bannerBaru)) {

        $query = "UPDATE guild_center SET
                    guild_name = '$nama',
                    guild_info = '$teks',
                    guild_img = '$bannerLama',
                    guild_post = '$share'
                    WHERE id_guild = $id";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);

     } 
    
     if ($bannerBaru) {

        if ($bannerBaru != $bannerLama) {
            
            global $conn;

            $pilih      = mysqli_query($conn, "SELECT * FROM guild_center WHERE id_guild ='$id'");
            $result     = mysqli_fetch_assoc($pilih);
            $dataGambar = $result['guild_img'];
            unlink('../../assets/img/guild_img/' . $dataGambar);

            $query = "UPDATE guild_center SET
                    guild_name = '$nama',
                    guild_info = '$teks',
                    guild_img = '$bannerBaru',
                    guild_post = '$share'
                    WHERE id_guild = $id";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
         
        }
         
     } 

}

// Function blocked guild
function blockGuild($data)
{
    global $conn;

    $id = base64_decode($_GET['data']);
    $aktif = 0;

    mysqli_query($conn, "UPDATE `guild_center` SET `guild_aktif`= '$aktif' WHERE id_guild = '$id'");

    return mysqli_affected_rows($conn);
}

// Function blocked guild
function aktifkan($data)
{
    global $conn;

    $id = base64_decode($_GET['data']);
    $aktif = 1;

    mysqli_query($conn, "UPDATE `guild_center` SET `guild_aktif`= '$aktif' WHERE id_guild = '$id'");

    return mysqli_affected_rows($conn);
}

// Delete Guild
function deleteMyGuild($data)
{
    global $conn;

    $id = base64_decode($_GET['data-guild']);

    $pilih = mysqli_query($conn, "SELECT * FROM guild_center WHERE id_guild ='$id'");
    $result = mysqli_fetch_assoc($pilih);
    $dataGambar = $result['guild_img'];
    unlink('../../assets/img/guild_img/' . $dataGambar);

    // Set guild_id 0 untuk Semua Member guild Yg Masih ada
    $memberGuild = mysqli_query($conn,"SELECT * FROM guild_info_member WHERE guild_id = '$id'");
    $takeUser = mysqli_fetch_assoc($memberGuild);

    $idUser = $takeUser['id_user'];

    // Update Id Guild Yg Baru
    $newId = 0;
    $user = "UPDATE guild_info_member SET guild_id = '$newId' WHERE id_user = '$idUser'";
    mysqli_query($conn,$user);

    // Hapus Guildnya
    mysqli_query($conn, "DELETE FROM `guild_center` WHERE id_guild = '$id'");

    return mysqli_affected_rows($conn);


}

// Function Report Guild
function reportGuild($data)
{
    global $conn;

    $guildId = base64_decode($_GET['guild']);
    $userId = $data['user'];

    // Isi Report
    $isi = htmlspecialchars(strip_tags(stripslashes($data['info'])),ENT_QUOTES);

    mysqli_query($conn,"INSERT INTO `report_guild`(`id_report_guild`, `guild_report`, `report_teks`, `user_report`) VALUES (null,'$guildId','$isi','$userId')");

    return mysqli_affected_rows($conn);
    
}

// Function Post Kiriman Ke Guild
function sendMyPost($data)
{
    global $conn;

    $idUser = $data['idUser'];
    $idGuild = $data['idGuild'];
    $post = htmlspecialchars(strip_tags(stripslashes($data['post'])),ENT_QUOTES);
    $date = date("Y-m-d H:i:s a");

    mysqli_query($conn, "INSERT INTO `guild_post`(`id_post`, `post`, `user_id`, `id_guild`, `post_date`) VALUES (null,'$post','$idUser','$idGuild','$date')");

    return mysqli_affected_rows($conn);
}

// Function Hapus Postingan
function deletePost($data)
{
    global $conn;

    $url = $_GET['data'];

    $id = base64_decode($url);

    mysqli_query($conn, "DELETE FROM `guild_post` WHERE id_post = '$id'");

    return mysqli_affected_rows($conn);
}

// Function Hapus Postingan
function editPost($data)
{
    global $conn;

    $url = $_GET['data'];

    $id = base64_decode($url);
    $post = htmlspecialchars(stripslashes($data['post']),ENT_QUOTES);

    mysqli_query($conn, "UPDATE `guild_post` SET `post`='$post' WHERE id_post = '$id'");

    return mysqli_affected_rows($conn);
}

// Function Report User Lain
function getReportSoon($data)
{
    global $conn;

    $idTersangka = $data['tersangka'];
    $pelapor = $data['pelapor'];
    $type = $data['typeMasalah'];
    $detail = htmlspecialchars(stripslashes(strip_tags($data['detail'])),ENT_QUOTES);
    $receive = 0;

    mysqli_query($conn,"INSERT INTO `report_user`(`id_report`, `reported_user`, `detail_report`, `from_user`, `id_type`, `is_receive`) VALUES (null,'$idTersangka','$detail','$pelapor','$type','$receive')");

    return mysqli_affected_rows($conn);
}

// Function Reply Report To User
function feedbackReport($data)
{
    global $conn;

    $idReport = $data['idReport'];
    $toUser = $data['userSend'];
    $read = 0;
    $feedback = htmlspecialchars(strip_tags(stripslashes($data['feedback'])),ENT_QUOTES);

    mysqli_query($conn, "INSERT INTO `feedback`(`id_feedback`, `feedback`, `id_report`, `user_id`, `is_read`) VALUES (null,'$feedback','$idReport','$toUser','$read')");

    $hasil =  mysqli_affected_rows($conn);

    if ($hasil > 0) {
        
        // Update Table report_user
        // column " is_receive"

        $receive = 1;

        mysqli_query($conn, "UPDATE `report_user` SET `is_receive` = '$receive' WHERE id_report = '$idReport'");

        return mysqli_affected_rows($conn);
    } 
    
}

// Function Hapus Report
function deleteReport($data)
{
    global $conn;

    $fromUserId = base64_decode($_GET['data']);

    mysqli_query($conn, "DELETE FROM `report_user` WHERE from_user = '$fromUserId'");

    return mysqli_affected_rows($conn);
}

// Function Hapus Report
function delreGuild($data)
{
    global $conn;

    $idReport = $_GET['data'];

    mysqli_query($conn, "DELETE FROM `report_guild` WHERE id_report_guild = '$idReport'");

    return mysqli_affected_rows($conn);
}

?>