<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Submenu Setting</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">

<?php  

// Data Semua List Menu
$listSubMenu = "SELECT * FROM sub_menu";

// Menampilkan Di web
$viewData = query($listSubMenu);

?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#modalSubmenu">
  Tambah Submenu Baru!
</button>

<?php 

// Query Menu Untul Select Form
$queryMenu = "SELECT * FROM menu";
$selectMenu = query($queryMenu);


if (isset($_POST['tambah'])) {
    if (tambahSubmenu($_POST) > 0) {
        // var_dump($_POST);
        echo showMessage('success','Berhasil','Submenu Baru Telah Ditambahkan');

    } else {
        echo showMessage('danger','Gagal','Something Wrong Happen , Sorry!');
        // echo mysqli_error($conn);
    }

}



?>

<div class="card shadow h-100 py-2 my-4 col-md-8">
    <div class="card-body">
        <h5 class="h5 mb-3 text-dark">
            <i class="fas fa-list fa-fw"></i>  List Submenu</h5>
              <hr class="bg-primary">
<table class="table table-hover table-responsive border-2 text-center rounded" cellspacing="10">
    <thead>
        <tr>
            <th>No.#</th>
            <th>Title</th>
            <th>Link Url</th>
            <th>Icon</th>
            <th>is_active</th>
            <th>System Disable</th>
        </tr>
        </thead>
        <tbody>

            <?php $i = 1; ?>
            <?php foreach($viewData as $sb) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $sb['title']; ?></td>
            <td>
                <a href="?mod=<?= $sb['url']; ?>" class="btn btn-link">
                    <i class="fas fa-link fa-fw"></i> Link url
                </a>
            </td>
            <td><i class="<?= $sb['icon'] ?> fa-fw fa-2x text-dark" aria-hidden="true"></i></td>
            <!-- Jika Aktif -->
            <td>
                <?php if($sb['is_aktif'] > 0) :?>
                <p class="small">
                    <span class="badge badge-success">running</span>
                </p>
                <?php elseif($sb['is_aktif'] < 1) :?>
                <p class="small">
                    <span class="badge badge-danger">Access Denied</span>
                </p>
                <?php endif ?>
            </td>
            <td>
                <?php if($sb['is_aktif'] > 0) :?>
                <a href="#block" class="btn btn-danger btn-sm tombolNonAktifkanSubMenu" data-block="<?= $sb['id'] ?>">Unactive</a>
                <?php elseif($sb['is_aktif'] < 1) :?>
                <a href="#aktif" class="btn btn-primary btn-sm tombolAktifkanSubMenu" data-active="<?= $sb['id'] ?>">activated</a>
                <?php endif ?>
            </td>
        </tr>
            <?php endforeach ?>

        </tbody>
</table>
    </div>
</div>


<!-- Tambah Data Submenu-->
<div class="modal fade" id="modalSubmenu" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Submenu Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <!-- <div class="container-fluid"> -->
                    <form action="" method="post">
                        <div class="form-group">
                          <label for="title" class="form-control-label">Judul Submenu</label>
                          <input type="text" name="title" id="title" class="form-control" placeholder="ex: Submenu Setting" required>
                        </div>
                        <div class="form-group">
                          <label for="url" class="form-control-label">Url</label>
                          <input type="text" name="url" id="url" class="form-control" placeholder="ex: subMenu" required>
                        </div>
                        <div class="form-group">
                          <label for="icon" class="form-control-label">Icon Submenu</label>
                          <input type="text" name="icon" id="icon" class="form-control" placeholder="ex: fas fa-icon" required>
                        </div>
                        <div class="form-group">
                          <label for="menuId">Untuk Bagian Menu ??</label>
                          <select class="form-control" name="menuId" id="menuId" required>
                              <option>-- Pilih Menu ---</option>
                            <?php foreach($selectMenu as $sm) : ?>
                            <option value="<?= $sm['id_menu'] ?>"><?= $sm['menu']; ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="active" id="active" value="1" checked required>
                            Is Submenu active ??
                          </label>
                        </div>
                <!-- </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah!</button>
            </div>
            </form>
        </div>
    </div>
</div>