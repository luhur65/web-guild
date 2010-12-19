<?php 

// Data Teman 
$friends = "SELECT * FROM guild_info_member";

if (isset($_POST['ok'])) {

    $search = htmlspecialchars(addslashes(strip_tags($_POST['search'])),ENT_QUOTES);
    $friends = inviteFriend($search);
}

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Undang Teman</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-secondary">

<form action="" method="post">
    <div class="row">
        <div class="col-lg">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Type name ... " required>
            </div>

        </div>

        <div class="col-lg-3">
            <button class="btn btn-outline-primary btn-block" type="submit" name="ok">
                <i class="fa fa-search fa-fw" aria-hidden="true"></i> Search Friends
            </button>
        </div>
    </div>
</form>

<!-- List Teman  -->
<div class="row mx-auto">
<?php if(isset($_POST['ok'])) :?>
<?php foreach($friends as $f) : ?>
    <div class="col-lg-8 card mt-3 p-2 <?= $retVal = ($f['role'] == 1) ? 'border-left-primary' : 'border-left-success' ; ?>">
        <a class="dropdown-item d-flex align-items-center justify-content-start" href="?mod=invite&q=<?= base64_encode($f['id_user'])?>">
            <div class="dropdown-list-image my-2">
                <img class="rounded-circle img-thumbnail"
                    src="<?= base_url; ?>/assets/img/user-icon/<?= $f['foto_profil']; ?>" alt="">
            </div>
            <div class="font-weight-bold col-lg-7">
                <div class="text-truncate"><?= $f['full_name']; ?> 
            </div>
            <div class="small text-gray-500 text-truncate"><?= $f['biografi']; ?></div>
            </div>
        </a>
    </div>
<?php endforeach ?>
<?php endif ?>
</div>
