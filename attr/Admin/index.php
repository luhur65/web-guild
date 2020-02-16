<?php 
require_once '../temp/auth_header.php'; 

// Cek Dulu Role Anggota 
if ($row['role'] == 'Anggota') {
  echo "<script>
  document.location.href = '".base_url."/attr/User'
</script>";
}

?>
  
<div class="container-fluid">

  <?php 
  if (isset($_SESSION['log_'])) {
  
      if (isset($_GET['mod'])) {
         $mod = $_GET['mod'];

         switch ($mod) {
           case 'profile':
             require_once 'profile/profile.php';
             break;
           case 'editProfile':
             require_once 'profile/edit_user.php';
             break;
           case 'blockByAdmin':
             require_once 'block_user.php';
             break;
           case 'openAccess':
             require_once 'active_user.php';
             break;
           case 'home':
             require_once 'home.php';
             break;
           case 'viewGuild':
             require_once 'guild/list_guild.php';
             break;
           case 'editData':
             require_once 'guild/editGuild.php';
             break;
           case 'blockGuild':
             require_once 'guild/action.php';
             break;
           case 'activated':
             require_once 'guild/action.php';
             break;
           case 'deleteGuildFromlist':
             require_once 'guild/delete.php';
             break;
           case 'settingMenu':
             require_once 'menu/menu_admin.php';
             break;
           case 'settingSubMenu':
             require_once 'submenu/submenu_admin.php';
             break;
           case 'access':
             require_once 'menu/accessMenu.php';
             break;
           case 'roleAccess':
             require_once 'viewRoleAccess.php';
             break;
           case 'viewListReport':
             require_once 'report/listReport.php';
             break;
           case 'guildCase':
             require_once 'report/guildReport.php';
             break;
           case 'seeDetail':
             require_once 'report/readmore.php';
             break;
           case 'deleteRp':
             require_once 'report/deleted.php';
             break;
           case 'delReportGuild':
             require_once 'report/deleteReportGuild.php';
             break;
           case 'rdGui':
             require_once 'report/guildRead.php';
             break;
           
           default:
             require_once '../404.html';
             break;
         }
      } elseif (!isset($_GET['mod'])) {
        require_once 'home.php';
        
      }
  }

  ?>
  
</div>
  

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url; ?>/attr/auth_out">Logout</a>
        </div>
      </div>
    </div>
  </div>

<?php require_once '../temp/auth_footer.php' ?>
