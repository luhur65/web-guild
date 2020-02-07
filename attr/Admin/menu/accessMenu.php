<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Access Menu</h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">

<?php 

// Role
$query = "SELECT * FROM guild_role";
$role = query($query);


?>

<div class="card shadow h-100 py-2 my-4 col-md-4">
    <div class="card-body">
        <h5 class="h5 mb-3 text-dark">
            <i class="fas fa-list fa-fw"></i> Role Access</h5>
              <hr class="bg-primary">
              <table class="table table-hover table-inverse table-responsive">
                  <thead class="thead-inverse">
                      <tr>
                          <th>No.</th>
                          <th>Role</th>
                          <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach($role as $r) : ?>
                          <tr>
                              <td><?= $i++ ?></td>
                              <td><?= $r['role']; ?></td>
                              <td>
                                  <a href="?mod=roleAccess&id=<?= $r['id_role']?>" class="badge badge-warning">access</a>
                                  <a href="" class="badge badge-info">Edit</a>
                                  <a href="" class="badge badge-danger">Delete</a>
                              </td>
                          </tr>
                          <?php endforeach ?>
                          </tr>
                      </tbody>
              </table>