<?php 


$id_role = $_GET['id'];

// Query Access Menu 
$Access = "SELECT * FROM guild_role JOIN access_menu ON guild_role.id_role = access_menu.id_role JOIN menu ON access_menu.id_menu = menu.id_menu WHERE guild_role.id_role = '$id_role'";
$queryAccess = mysqli_query($conn,$Access);

$acc = mysqli_fetch_assoc($queryAccess);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Role : <?= $acc['role']; ?></h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>
<hr class="bg-dark">

<table class="table">
    <thead>
        <tr>
            <th scope="row">Menu</th>
            <th scope="row">Access</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($queryAccess as $q): ?>
        <tr>
            <td><?= $q['menu']; ?></td>
            <td>
            <div class="form-check">
                <input  class="form-check-input" type="checkbox" checked data-role="<?= $q['id_role']; ?>" data-menu="<?= $q['id_menu']; ?>">
            </div>
            </td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>



