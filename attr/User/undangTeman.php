<?php 

// Data Teman 

$friends = "SELECT * FROM guild_info_member";

if (isset($_POST['ok'])) {
    
    $friends = inviteFriend($_POST['search']);
}

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Undang Teman</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-secondary">

<form action="" method="post">
    <div class="form-group col-lg-5 form-inline">
        <input type="text" name="search" class="form-control mr-2">
        <button class="btn btn-outline-primary" type="submit" name="ok">
            <i class="fa fa-search-plus fa-fw" aria-hidden="true"></i>
        </button>
    </div>
</form>

<!-- List Teman  -->
<?php if(isset($_POST['ok'])) :?>
    <?php foreach($friends as $f) : ?>
    <a class="dropdown-item d-flex align-items-center col-lg-5" href="?mod=invite&q=<?= base64_encode($f['id_user'])?>">
        <div class="dropdown-list-image mr-3">
            <img class="rounded-circle img-thumbnail" src="<?= base_url; ?>/assets/img/user-icon/<?= $f['foto_profil']; ?>" alt="">
        </div>
        <div class="font-weight-bold col-lg-7">
            <div class="text-truncate"><?= $f['full_name']; ?></div>
            <div class="small text-gray-500 text-truncate">Bio :: <?= $f['biografi']; ?></div>
        </div>
    </a>
    <?php endforeach ?>
<?php endif ?>