<div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="sidebar-heading text-light"><b>Dropbox Api</b></div>
      <div class="list-group bg-dark">
        <a href="index.php" class="list-group-item bg-dark text-light list-group-item-action"><i class="fa fa-home"></i>   Home</a>
         
         <a href="users.php" class="list-group-item list-group-item-action bg-dark text-light "><i class="fa fa-users" aria-hidden="true"></i> Users Management </a>

         <?php 

          if(!empty($_SESSION['user']['dropbox_token'])){
            ?>
            <a href="files.php" class="list-group-item list-group-item-action bg-dark text-light "><i class="fa fa-file" aria-hidden="true"></i> Files Management</a>
            <?php
          }

         ?>
        
        <a href="change_password.php" class="list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-key" aria-hidden="true"></i>  Change Password</a>
      </div>
    </div>