<!-- Start of Check Session -->
<?php
            
    session_start();
    if(!isset($_SESSION['user']))
    {
        header('location:index.php');
    }        

?>
<!-- End of Check Session -->
<!---Start of Header -->
<?php 
	$title = "Dashboard";
	require_once 'includes/header.php';  
?>
<!-- End of Header -->


 <!-- Start of Main Body -->
  <div class="d-flex" id="wrapper">

      <!-- Start of Sidebar -->
      <?php require_once 'includes/siderbar.php';  ?>
      <!--- End of Sidebar  -->

      <div id="page-content-wrapper">


        <!-- Start of Navigation -->
        <?php require 'includes/navigation.php';  ?>
        <!-- End of Navigation -->


         <!-- Start of Container -->
        <div class="container-fluid">
            <nav aria-label="breadcrumb" style="margin-top: 20px;">
              <ol class="breadcrumb shadow-sm bg-white p-3">
                <li class="breadcrumb-item"><i class="fa fa-file"></i> <a class="text-dark" href="files.php" style="text-decoration: none;">Dropbox Files</a> </li>
              </ol>
            </nav>


            <div class="card shadow-sm bg-white p-1">
              <div class="card-body">
                <h6 class="text-dark"><i class="fa fa-eye"></i> View Files and Folders  | <a href="upload.php" class="btn btn-dark"><i class="fa fa-plus-circle"></i> Add New File</a></h6>
                <hr/>

                <?php


                  if(isset($_SESSION['success']))
                  {
                    ?>
                    <div class="alert alert-success">
                      <b><?php echo $_SESSION['success'] ?></b>
                    </div>
                    <?php
                    unset($_SESSION['success']);
                  }else if(isset($_SESSION['error']))
                  {
                    ?>
                    <div class="alert alert-danger">
                      <b><?php echo $_SESSION['error'] ?></b>
                    </div>
                    <?php
                    unset($_SESSION['error']);
                  }

                ?>

                <!-- Start of Form -->
                <table id="table" class="table table-hover table-striped table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th>SR#</th>
                      <th>File and Folders</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php

                        require_once 'classes/Files.php';
                        $files = new Files();
                        $token = $_SESSION['user']['dropbox_token'];
                        $result = $files->getFiles($token);
                        $a = 0;
                        foreach ($result['entries'] as $data)
                        {
                          ?>
                          <tr>
                            <td><?= ++$a; ?></td>
                            <td>
                              <?php 

                                if(preg_match( '/[.]/', $data['name'] ))
                                {
                                 ?>
                                <span class="badge badge-primary bg-primary"> File </span> <?= $data['name']?> 
                                 <?php
                                }else
                                {
                                  ?>
                                  <a style="text-decoration:none" class="text-dark" href="view_files.php"><span class="badge badge-success bg-success"> Folder </span> <?= $data['name']?> </a>
                                  <?php
                                }

                              ?>
                              
                                
                            </td>
                            <td>
                              <?php 

                                if(preg_match( '/[.]/', $data['name'] ))
                                {
                                
                                   ?>
                                  <a class="btn btn-primary" id="download-btn" value="<?= $data['name']?>"><i class="fa fa-download"></i></a>

                                  <a class="btn btn-success" id="share-btn" value="<?= $data['name']?>"><i class="fa fa-share"></i></a>

                                   <a class="btn btn-primary" id="preview-btn" value="<?= $data['name']?>"><i class="fa fa-eye"></i></a>

                                    <a class="btn btn-danger" id="preview-btn" value="<?= $data['name']?>"><i class="fa fa-trash"></i></a>
                                   <?php
                                }else
                                {
                                  ?>
                                   <a class="btn btn-danger" id="preview-btn" value="<?= $data['name']?>"><i class="fa fa-eye"></i></a>
                                  <?php
                                }

                              ?>
                              
                              
                            </td>
                          </tr>
                          <?php
                        }
                    ?>  
                  </tbody>
                </table>
                <!-- End of Form -->
  
              </div>
            </div>
        </div>
        <!-- End of Container -->

      </div>
  </div>
 <!-- End of Main Body -->



<!-- Start of Footer -->
<?php   require_once 'includes/footer.php'; ?>
<!-- End of Footer