<?php
session_start();

// Butuh File Config.php
// Di folder config
require_once '../../config/config.php';

// Session Masuk
$guild_session = $_SESSION['log_'];

// Cek Jika Tidak Ada Session
if (!isset($_SESSION['log_'])) {
    // Kembalikan Ke Halaman Login
    header('Location: ../login');
} 

// Query Data Info user Dari @Param Session Masuk
$data_query = "SELECT * FROM guild_info_member INNER JOIN guild_role ON guild_role.id_role = guild_info_member.role WHERE username = '$guild_session' or email = '$guild_session'";
$query    = mysqli_query($conn,$data_query);

// Pecah Data User Yg Login
$detail = mysqli_fetch_assoc($query);

// Ambil Data Yg Diperlukan Saja
$guild_saya =  $detail['guild_id'];

// Query List Guild (Join Guild)
$dataListGuild = "SELECT * FROM guild_center";
$listGuild = query($dataListGuild);

// Query List Guild (  Guild Saya )
$oneGuild = "SELECT * FROM guild_center INNER JOIN guild_info_member ON guild_center.id_guild = guild_info_member.guild_id WHERE guild_id = '$guild_saya' and username = '$guild_session'";
$takeOneGuild = query($oneGuild);

?>

<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="og:Web Chatting" property="og:Chatting With Your Friends" content="Web Chatting">
  <meta name="robots" content="noindex , nofollow">
  <meta name="description" content="Web Chatting Made In Indonesia">
  <meta name="author" content="dhrm_stmrng">

  <title>Beranda Saya</title>

  <link rel="icon" href="<?= base_url ?>/assets/img/favicon.png">

  <!-- Custom fonts for this template-->
  <link href="<?= base_url;?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600&display=swap" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Argon CSS -->
  <!-- <link type="text/css" href="<?= base_url; ?>/assets/css/argon.css?v=1.1.0" rel="stylesheet"> -->

  <!-- Custom styles for this template-->
  <link href="<?= base_url;?>/assets/css/sb-admin-2.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?= base_url;?>/assets/css/style.css" rel="stylesheet">
  <!-- Lightbox -->
  <link href="<?= base_url;?>/assets/vendor/lightbox/css/lightbox.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <?php foreach($query as $row): ?>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-main navbar-nav bg-gradient-dark sidebar sidebar-dark accordion navbar-dark"
      id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?mod=home">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Beranda</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php 
      // Menu Query 
      $id_role = $detail['id_role'];

      $queryMenu = "SELECT menu.id_menu , menu.menu FROM menu JOIN access_menu ON  menu.id_menu = access_menu.id_menu WHERE access_menu.id_role  = '$id_role' ORDER BY access_menu.id_menu ASC ";

      $tampilkanMenu = mysqli_query($conn,$queryMenu);
      $m = mysqli_fetch_assoc($tampilkanMenu);   
      
      ?>

      <!-- Heading Menu-->
      <?php foreach($tampilkanMenu as $m) : ?>
      <div class="sidebar-heading display-4 text-white">
        <?= $m['menu']; ?>
      </div>

      <?php
      
      // Query SubMenu
      $menuId = $m['id_menu'];
      
      $querySubMenu = "SELECT * FROM sub_menu WHERE menu_id = '$menuId' AND is_aktif =1 ";

      $tampilkanSubMenu = query($querySubMenu);
      
      ?>

      <!-- Nav Item - Dashboard -->
      <?php foreach($tampilkanSubMenu as $sub) : ?>

      <li class="nav-item">
        <a class="nav-link pb-0" href="?mod=<?= $sub['url'] ?>">
          <i class="<?= $sub['icon']; ?> fa-fw" aria-hidden="true"></i>
          <span><?= $sub['title'] ?></span></a>
      </li>

      <?php endforeach; ?>
      <!-- Divider -->
      <hr class="sidebar-divider mt-3">

      <?php endforeach; ?>

      <?php if($detail['id_role'] == '2'):?>
      <?php if($detail['guild_id'] < 1) : ?>

      <div class="sidebar-heading">
        Guild
      </div>

      <li class="nav-item">
        <a class="nav-link pb-0" href="?mod=joinToGuild">
          <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>
          <span>Join Guild</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link pb-0" href="?mod=makeNewGuild">
          <i class="fas fa-user-friends fa-fw"></i>
          <span>Create Guild</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider mt-3">

      <?php elseif($detail['guild_id'] > 0): ?>
      <?php foreach($takeOneGuild as $g): ?>

      <div class="sidebar-heading">
        <i class="fas fa-users fa-fw"></i>
        My Guild
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <span><?= $g['guild_name'] ?></span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header"></h6> -->
            <a class="collapse-item text-info" href="?mod=viewMyGuildID&idGuild=<?= base64_encode($g['id_guild']); ?>">
              <i class="fa fa-eye fa-fw" aria-hidden="true"></i> Lihat Guild
            </a>
            <a class="collapse-item text-primary" href="?mod=sendMessage&guild=<?= base64_encode($g['id_guild']);?>'">
              <i class="fas fa-comments fa-fw"></i> Guild Chat
            </a>
            <a class="collapse-item text-primary" href="?mod=undangTeman">
              <i class="fas fa-user-friends fa-fw"></i> Undang Teman
            </a>
            <a class="collapse-item text-danger" href="?mod=getOutFromGuild&user=<?= $g['id_user']; ?>">
              <i class="fas fa-sign-out-alt fa-fw"></i> Keluar dari Guild
            </a>
            <a class="collapse-item text-danger" href="?mod=guildReport&guild=<?= base64_encode($g['id_guild']) ?>">
              <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i> Laporkan Guild
            </a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider mt-3">

      <?php endforeach; ?>
      <?php endif ?>
      <?php endif ?>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url; ?>/attr/auth_out" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Log Out</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->




    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3 d-md-none">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">



            <?php if($detail['id_role'] === '1') : ?>

            <?php 
            
            // Jika Ada Pesan Atau Ada Aktivitas Dari User
            
            // Data Report Dari Database
            $queryReport = "SELECT * FROM report_user JOIN report_type On report_user.id_type = report_type.id_type JOIN object_report ON report_type.object_report = object_report.id_object JOIN guild_info_member ON guild_info_member.id_user = report_user.from_user Order By id_report DESC";

            $arrayReport = query($queryReport);

            // Jumlah Report 
            $dataJumlah = "SELECT * FROM report_user WHERE is_receive = 0";
            $total = count(query($dataJumlah));
            
            ?>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php foreach($arrayReport as $ar) : ?>
                <?php if($ar['is_receive'] === '0') :?>
                <span class="badge badge-danger badge-counter"><?= $total; ?></span>
                <?php endif ?>
                <?php endforeach ?>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Reporting User
                </h6>
                <?php foreach($arrayReport as $ar) : ?>
                <?php if($ar['is_receive'] === '0') :?>
                <a class="dropdown-item d-flex align-items-center"
                  href="?mod=seeDetail&data=<?= base64_encode($ar['id_report']); ?>">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle img-anggota img-fluid img-responsive"
                      src="<?= base_url; ?>/assets/img/user-icon/<?= $ar['foto_profil']; ?>" alt="Profil">
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Saya Mengirim Sebuah Report</div>
                    <div class="small text-info"><?= $ar['full_name']; ?> ·</div>
                  </div>
                </a>
                <?php elseif($ar['is_receive'] === '1') :?>
                <a class="dropdown-item d-flex align-items-center"
                  href="?mod=seeDetail&data=<?= base64_encode($ar['id_report']); ?>">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-check fa-fw text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-info"><?= $ar['full_name']; ?></div>
                    Report Ini Sudah Di FeedBack
                  </div>
                </a>
                <?php endif ?>
                <?php endforeach ?>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">43535</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Pesan
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Bagi Source Code Web ini dong gan ??? </div>
                    <div class="small text-gray-500">Dharma · 2020-01-05</div>
                  </div>
                </a>
              </div>
            </li>

            <?php elseif($detail['id_role'] === '2') : ?>

            <?php 

              $id = $detail['id_user'];
              
              // Pemeberitahuan
              $arrayAlert = "SELECT * FROM feedback WHERE user_id = '$id'";
              $dataAlert = mysqli_query($conn, $arrayAlert);

              $alert = mysqli_fetch_assoc($dataAlert);
              
              ?>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php if($alert['is_read'] === '0') :?>
                <span class="badge badge-danger badge-counter"><?= count(query($arrayAlert)); ?></span>
                <?php else : ?>
                <span class="badge badge-danger badge-counter"></span>
                <?php endif ?>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Pemberitahuan
                </h6>
                <?php if($alert['is_read'] === '0') :?>
                <?php foreach($dataAlert as $ale) :?>
                <a class="dropdown-item d-flex align-items-center"
                  href="?mod=read&data=<?= base64_encode($ale['id_feedback']); ?>">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-bell fa-fw text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">Hasil Report Anda!</div>
                    <span class="font-weight-bold"><?= substr($ale['feedback'],0,24); ?>...</span>
                  </div>
                </a>
                <?php endforeach ?>
                <a class="dropdown-item text-center small text-danger btn btn-link"
                  href="?mod=deleteAllNotif&data-user=<?= $alert['user_id']; ?>"><i class="fas fa-trash-alt fa-fw"></i>
                  Hapus Semua Pesan</a>
                <?php endif ?>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                      having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <?php endif ?>
            <div class="topbar-divider d-none d-sm-block"></div>





            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-600 small"><?= $detail['full_name']; ?></span>
                <img class="img-profile rounded-circle" src="../../assets/img/user-icon/<?= $detail['foto_profil'] ?>"
                  alt="Profil Saya">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="?mod=profile" id="profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url; ?>/attr/auth_out" data-toggle="modal"
                  data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        <?php endforeach ?>