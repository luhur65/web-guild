<?php 

if (likePost() > 0) {
    // echo 'berhasil';
    echo "<script>document.location.href='?mod=home'</script>";
} else {
    // echo 'gagal';
    echo "<script>document.location.href='?mod=home'</script>";
}

?>