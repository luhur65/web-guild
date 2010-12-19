<?php 

// data orang & postingannya
$post = base64_decode($_GET['post']);
$dataPost = "SELECT * FROM guild_post JOIN guild_info_member On guild_post.user_id = guild_info_member.id_user WHERE id_post = '$post'";
$queryPost = mysqli_query($conn, $dataPost);
$p = mysqli_fetch_assoc($queryPost);

// data komentar
$dataKomentar = "SELECT * FROM `data_comment` JOIN guild_post ON guild_post.id_post = data_comment.id_comment_post JOIN guild_info_member ON guild_info_member.id_user = data_comment.user_comment WHERE id_post = '$post' Order By id_comment ASC";
$queryKomentar = query($dataKomentar);

// jika user menekan tombol kirim
if(isset($_POST['send'])){

    if (comment($_POST) > 0) {
        echo alertPopUp('Berhasil Mengirim Koment Anda!', '');
    } else {
        echo alertPopUp('Gagal Mengirim Koment Anda!', '');
    }
}

?>

<div class="row">
    <div class="col-lg-6 mb-2">

        <!-- data postingan & commentar -->
        <div class="card">
            <div class="card-body">
                <img src="<?= base_url; ?>/assets/img/user-icon/<?= $p['foto_profil']; ?>"
                    class="img-fluid img-anggota rounded-circle" alt="73g27ge8g28d728273tgd67w">
                <span class="text-primary">Postingan <?= $p['full_name']; ?></span>
                <div class="form-group mt-3">
                    <textarea class="form-control bg-white mt-3 mb-3" rows="8" required
                        readonly><?= str_replace('<br />', "" ,$p['post']) ?></textarea>
                </div>
            </div>

        </div>
        <div class="card mt-2">
            <ul class="list-group list-group-flush">
                <?php foreach($queryKomentar as $k) : ?>
                <li class="list-group-item">
                <img src="<?= base_url; ?>/assets/img/user-icon/<?= $k['foto_profil']; ?>"
                    class="img-fluid img-anggota rounded-circle" alt="Gambar Komentar Public"> <?= $k['full_name']; ?>
                    <p class="lead mt-2">
                        <?= $k['comment']; ?>
                    </p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>

    <div class="col-lg-6">

        <!-- form mengirim komentar -->
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="comment">
                            <span class="text-dark">Comment</span>
                        </label>
                        <textarea class="form-control" name="comment" id="comment" rows="3"
                            placeholder="type your comment ..."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="send">
                            <i class="fa fa-paper-plane fa-fw" aria-hidden="true"></i>
                            Kirim!
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>