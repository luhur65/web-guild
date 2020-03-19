<?php require_once '../config/config.php'; ?>
<!-- Template Header -->
<?php require_once 'temp/header.php';  ?>
<body class="bg-gradient-default">
<main>
    <section class="section section-shaped section-lg">
      <div class="shape shape-style-1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="container pt-lg-md">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card bg-secondary shadow border-0">
              <div class="card-header bg-white pb-2">
                <div class="text-muted text-center">
                  <h4>Create New Account !</h4>
                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-muted">
                <?php if(isset($_POST['sign_in'])):?>
                <?php if(daftarAkunBaru($_POST) > 0):?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <strong>Berhasil!</strong> Login Sekarang --> [ <a href="<?= base_url ?>/attr/login" class="text-white">Login</a>. ]
                </div>
                <?php else  : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <strong>Gagal!</strong> Ada Kesalahan , Periksa Kembali .
                </div>
                <?php endif;?>
                <?php endif;?>
                </div>
                <form class="user" action="" method="POST">
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user-circle fa-fw" aria-hidden="true"></i></span>
                      </div>
                      <input class="form-control" placeholder="Nama Lengkap" type="text" name="FullName" required autofocus autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-venus-mars fa-fw" aria-hidden="true"></i></span>
                      </div>
                    <select class="custom-select form-control" name="gender">
                      <option selected>--Pilih Jenis Kelamin--</option>
                      <option value="1">Laki - Laki</option>
                      <option value="2">Perempuan</option>
                    </select>
                    </div>
                  </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control" placeholder="-- Tanggal Lahir --" type="date" name="tglLahir">
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hat-wizard    "></i></span>
                      </div>
                      <input class="form-control" placeholder="Create Your Nickname" type="text" name="username" required autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></span>
                      </div>
                      <input class="form-control" placeholder="Email Address" type="email" required autocomplete="off" name="InputEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock-open fa-fw   "></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" type="password" name="main_pass" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                      </div>
                      <input class="form-control" placeholder="Konfirmasi Password" type="password" name="RepeatPassword" required>
                    </div>
                  </div>
                  <div class="row my-4">
                    <div class="col-12">
                      <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                        <label class="custom-control-label" for="customCheckRegister"><span class="text-dark">I agree with the <a href="#">Privacy Policy</a></span></label>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4 btn-block" name="sign_in">Create account</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-6">
                <a href="<?= base_url; ?>/attr/login" class="text-white"><small>&larr; Kembali Ke Halaman Login</small></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php require_once 'temp/footer.php'; ?>