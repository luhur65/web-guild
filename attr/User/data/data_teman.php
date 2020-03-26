<?php 

require_once '../../../config/config.php';

$teman = $_GET['data'];

// Data Teman 
$query = "SELECT * FROM guild_info_member 
                WHERE
            id_user LIKE '%$teman%' OR
            full_name LIKE '%$teman%' OR 
            username LIKE '%$teman%' OR
            email LIKE '%$teman%'
        ";

$show = query($query);

// count friends
$count = count($show);

?>

<div class="row mx-auto">

    <?php if($count > 0) : ?>
    <?php foreach($show as $f): ?>

    <div
        class="col-lg-8 card mt-3 p-2 <?= $retVal = ($f['role'] == 1) ? 'border-left-primary' : 'border-left-success' ; ?>">
        <a class="dropdown-item d-flex align-items-center justify-content-start"
            href="?mod=invite&q=<?= base64_encode($f['id_user']) ?>">
            <div class="dropdown-list-image my-2">
                <img class="rounded-circle img-thumbnail"
                    src="<?= base_url; ?>/assets/img/user-icon/<?= $f['foto_profil']; ?>" alt="<?= $f['full_name']; ?>">
            </div>
            <div class="font-weight-bold col-lg-7">
                <div class="text-truncate"><?= $f['full_name']; ?>
                </div>
                <div class="small text-gray-500 text-truncate"><?= $f['biografi']; ?></div>
            </div>
        </a>
    </div>

    <?php endforeach; ?>
    <?php else: ?>

        <div class="card border-0 justify-content-center mx-auto mt-4 bg-light">
            <div class="card-body">
                <h4 class="card-title text-danger text-center">Nama Teman Tidak Ada!</h4>
                <p class="lead mb-0 text-center"><span class="showName">" Harap Periksa Nama Teman yg ingin anda undang!  "</span> </p>
            </div>
        </div>

    <?php endif; ?>
</div>
