<?php 
require_once '../temp/auth_header.php'; 

?>

<div class="container-fluid">
  <?php 
  if (isset($_SESSION['log_'])) {
      if (isset($_GET['mod'])) {
         $mod = htmlspecialchars(addslashes(strip_tags($_GET['mod'])),ENT_QUOTES);

         switch ($mod) {
           case 'sendMessage':
             require_once 'messages/index.php';
             break;
           case 'listMail':
             require_once 'maillist.php';
             break;
           case 'mail':
             require_once 'chat.php';
             break;
           case 'readMail':
             require_once 'readMail.php';
             break;
           case 'invite':
             require_once 'invite.php';
             break;
           case 'profile':
             require_once 'profile/profile.php';
             break;
           case 'editProfile':
             require_once 'profile/edit_user.php';
             break;
           case 'home':
             require_once 'home.php';
             break;
           case 'undangTeman':
             require_once 'undangTeman.php';
             break;
           case 'joinToGuild':
             require_once 'guild/joinGuild.php';
             break;
           case 'makeNewGuild':
             require_once 'guild/createGuild.php';
             break;
           case 'setPassword':
             require_once 'guild/guild_pass.php';
             break;
           case 'viewMyGuildID':
             require_once 'guild/index.php';
             break;
           case 'editData':
             require_once 'guild/editGuild.php';
             break;
           case 'guildReport':
             require_once 'guild/reportGuild.php';
             break;
           case 'getOutFromGuild':
             require_once 'guild/getOut.php';
             break;
           case 'viewUser':
             require_once 'viewBase.php';
             break;
           case 'reportUser':
             require_once 'report/index.php';
             break;
           case 'nextReport':
             require_once 'report/next.php';
             break;
           case 'hapusPostingan':
             require_once 'deletePost.php';
             break;
           case 'editMyPost':
             require_once 'editDataPost.php';
             break;
           case 'seeMore':
             require_once 'readPost.php';
             break;
           case 'read':
             require_once 'readNotif.php';
             break;
           case 'deleteAllNotif':
             require_once 'Delete.php';
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary"
          href="<?= base_url; ?>/attr/auth_out">Logout</a>
      </div>
    </div>
  </div>
</div>

<?php require_once '../temp/auth_footer.php'  ?>