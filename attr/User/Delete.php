<?php 

// Function Delete Feedback
function deleteNotif($data)
{
    global $conn;

    $id = $_GET['data-user'];

    mysqli_query($conn,"DELETE FROM `feedback` WHERE user_id = '$id'");

    return mysqli_affected_rows($conn);
}

// Jika Ada
if (deleteNotif($_POST) > 0) {
    echo alertPopUp('Berhasil Menghapus Semua Pesan','?mod=home');
} else {
     echo alertPopUp('Gagal Menghapus Semua Pesan','?mod=home');
}
