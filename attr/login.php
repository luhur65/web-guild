<?php require_once '../config/config.php';
require_once 'Oauth/auth_log.php';
// Jika Ada user Yg Masih Login
if (isset($_SESSION['log_'])) {
    header('Location: Admin');
    exit;
}

?>
<?php require_once 'temp/header.php'; ?>

<body class="bg-gradient-primary">

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
          <div class="col-lg-7">
            <div class="card bg-secondary shadow border-3">
              <div class="card-header bg-white pb-3">
                <div class="text-muted text-center">
                  <h5>Login</h5>
                </div>
                <div class="text-muted text-center">
                  <small>Welcome To GuildRoom</small> |
                  <small>Login With Your Account</small>
                </div>
                <div class="btn-wrapper text-center">

                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-muted mb-3">
                  <small>Login With Your Nickname Or Email Address</small>
                </div>
                <?php global $cekRole; if (isset($cekRole)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="alert-inner--text"><strong>Denied!</strong> Akun Anda Telah Kami Blokir!</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php global $error; global $login_kosong; ?>
                <?php elseif (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="alert-inner--text"><strong>INVALID!</strong> Password Or Nickname Wrong !, <?= $_POST['username']; ?> </span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php elseif (isset($login_kosong)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="alert-inner--text"><strong>Danger!</strong> Harap Isi Semua Form!</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php endif; ?>
                <form action="" method="POST" class="user">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input class="form-control" placeholder="Email Address Or Nickname" type="text" name="username"
                        required autocomplete="off" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" type="password" required name="password">
                    </div>
                  </div>
                  <!-- <div class="custom-control custom-control-alternative custom-checkbox">
                    <input class="custom-control-input" id="customCheckLogin" type="checkbox">
                    <label class="custom-control-label" for="customCheckLogin">
                      <span class="text-dark">Remember me</span>
                    </label>
                  </div> -->
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4 btn-block" name="log_">Login</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-3">
              <!-- <div class="col-6">
                <a href="#" class="text-light"><small>Forgot password?</small></a> 
              </div> -->
              <div class="col-6">
                <a href="<?= base_url; ?>/attr/register"
                  class="text-white"><small>Daftar Akun Baru</small></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php require_once 'temp/footer.php';
