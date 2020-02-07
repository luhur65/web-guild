<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu Setting</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">

<?php 

// Query Data Menu
$menu = "SELECT * FROM menu";
$view = query($menu);

// Jika Tombol Tambah Menu Ditekan
if (isset($_POST['tambah'])) {
    
    if (tambahMenu($_POST) > 0) {
        echo showMessage('success','Berhasil','Menu Baru Telah Ditambahkan!');
    } else {
        echo showMessage('danger','Gagal','Something Wrong Happen , Sorry !');
    }
}

?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newMenuModal">
  Tambah Menu Baru!
</button>


<div class="card shadow h-100 py-2 my-4 col-md-4">
    <div class="card-body">
        <h5 class="h5 mb-3 text-dark">
            <i class="fas fa-list fa-fw"></i> List Menu</h5>
              <hr class="bg-primary">
                <table class="table table-hover table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>No.</th>
                            <th>List Menu</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($view as $v) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $v['menu'] ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                      <label for="name">Nama Menu</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="ex: User">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="tambah">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>