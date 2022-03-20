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
                <h6 class="text-dark"><i class="fa fa-eye"></i> View Files and Folders</h6>
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
                <form action="process.php" method="POST" id="form" enctype="multipart/form-data">

                     <div class="form-group mb-2">
                        <label>Folder Name </label>
                        <select name="folder" required class="form-select">
                            <option value="">--SELECT FOLDER----</option>
                            <option value="root">Root Directory</option>
                            <option value="test">Test</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Upload File <span class="text-danger">*</span></label>
                        <input type="file" name="file" required class="form-control"/>
                    </div>


                    <div class="form-group mb-2">
                        <center>
                            <button type="submit" name="upload_file" class="btn btn-danger"><i class="fa fa-upload"></i> Upload File</button>
                        </center>
                    </div>
                </form>
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