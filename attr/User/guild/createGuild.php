<?php 

// Create New Guild
if (isset($_POST['newGuild'])) {
    
    if (newGuild($_POST) > 0) {
        
        // success 
        $success = true;

    } else {
        
        // gagal
        $fail = true;
    }
}

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <span class="text-muted small"><?= date('l , d M Y') ?></span>
</div>

<div class="card shadow p-4 rounded col-lg-8 mx-auto">
    <div class="card-header rounded bg-primary text-white">
        <h3>Create Your Own Guild</h3>
    </div>
    <div class="card-body">

        <?php if (isset($success)) {
        
        echo showMessage('success','Congratulation!','You Have Guild Now');

    } elseif(isset($fail)) {

        echo showMessage('danger','Bad News!','Something Happen Wrong When You are Creating');
    }

    ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="creator" value="<?= $detail['id_user']; ?>" readonly>
            <div class="row">
                <div class="col-sm-3">
                    <label for="name">Guild Name</label>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <input type="text" name="guildName" id="name" class="form-control"
                            placeholder="Your Guild Name's">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="info">Guild Description</label>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <textarea class="form-control" name="info" id="info" rows="4"
                            placeholder="Description for your guild"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="akses">Guild Akses</label>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <select class="custom-select" name="share" id="akses">
                            <option selected>-- Pilih Akses Guild Anda ---</option>
                            <option value="Private">Private Guild</option>
                            <option value="Public">Public Guild</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="gambar">Guild Image</label>
                </div>
                <div class="col-md">
                    <div class="custom-file mt-2">
                        <input type="file" name="gambar" class="custom-file-input" id="gambar" required>
                        <label for="gambar" class="custom-file-label">Choose Guild Image</label>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3"></div>
                <div class="col-md">
                    <button type="submit" class="btn btn-success btn-block" name="newGuild">
                        Create My Guild!
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- <div class="card-footer text-muted">
        Footer
    </div> -->
</div>