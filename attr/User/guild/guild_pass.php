<?php 

// Set password Untuk Guild Private
$id = base64_decode($_GET['data']);

$guild = query("SELECT * FROM guild_center INNER JOIN guild_info_member ON guild_info_member.id_user = guild_center.creator WHERE guild_center.id_guild = '$id'");


// Jika Passsword Belum Ada
if (isset($_POST['ok'])) {
    
    if ($_POST['pass'] != $_POST['pass2']) {

        $passDiff = true;

    } else {

        if (setPassword($_POST) > 0) {
             $success = true;
        } else {
            $error = true;
        }
    }

}

?>

<?php foreach($guild as $g) : ?>

    <?php if(!($g['guild_pass'])) : ?>

        <div class="card col-lg-5 mx-auto shadow">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Set Password</h4>
                <hr>
                <div class="mt-4">

                <?php if(isset($passDiff)) : ?>
                <?= showMessage('danger','Wrong!','Password Did Not Match, Check it!'); ?>
                <?php elseif(isset($success)) : ?>
                <?= showMessage('success','Congratulation!','Password Now Activated'); ?>
                <?php elseif(isset($error)) : ?>
                <?= showMessage('danger','Error!','Password Can Not Set!'); ?>
                <?php endif ?>
                
                <form action="" method="post">

                    <div class="form-group">
                      <label for="pass">Create Password</label>
                      <input type="password" class="form-control" name="pass" id="pass" aria-describedby="helpId" required>
                      <small id="helpId" class="form-text text-muted">Create Password For Your Guild</small>
                    </div>

                    <div class="form-group">
                      <label for="pass2">Konfirmasi Password</label>
                      <input type="password" class="form-control" name="pass2" id="pass2" required>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success btn-block" name="ok">
                            Save Password!
                        </button>
                    </div>
                </form>
                
                </div>

            </div>
        </div>

        <?php elseif($g['guild_pass']) : ?>

        <div class="card col-lg-5 mx-auto shadow">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Change Password</h4>
                <hr>
                <div class="mt-4">
                
                <form action="" method="post">

                    <div class="form-group">
                      <label for="pass1">Password Lama</label>
                      <input type="password" class="form-control" name="oldPass" id="pass1" required>
                    </div>

                    <div class="form-group">
                      <label for="pass2">Password Baru</label>
                      <input type="password" class="form-control" name="newPass" id="pass2" required>
                    </div>

                    <div class="form-group">
                      <label for="pass3">Konfirmasi Password</label>
                      <input type="password" class="form-control" name="confirmNewPass" id="pass3" required>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success btn-block" name="change">
                            Save Changes Password!
                        </button>
                    </div>
                </form>
                
                </div>

            </div>
        </div>
    
    <?php endif ?>

<?php endforeach ?>