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


        

        <!-- Start of Integrration Button -->
        
          <?php 

            if(isset($_SESSION['user']) && $_SESSION['user']['dropbox_token'] == "")
            {

              ?>
              <div class="card shadow-sm bg-whie p-3">
               <div class="card-body">
              <?php
                //***Start of Require Config*******//
                 echo "<a class='btn btn-primary' href='login.php'><i class='fa fa-balloon'></i> Integrate With Dropbox</a>";
                //***End of Require Config*******//
              ?>
              </div>
              </div>
              <?php
            }else
            {
              ?>
              <div class="card shadow-sm bg-whie p-3">
               <div class="card-body">
              <?php
               echo "<a class='btn btn-danger' href='process.php?action=disconnect'><i class='fa fa-remove'></i> Disconnect DropBox</a>";
             ?>
              </div>
              </div>
              <?php
            }

          ?>
      
        <!-- End of Integration Button -->

        <!-- Start of Content -->
        <div class="container mt-5">
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
           <div class="row">
             <div class="col-md-4">
               <div class="card shadow p-3 mb-5 bg-white rounded">
                 <div class="card-body">
                   <h4><i class="fa fa-users"></i>  Total Users  <span class="badge badge-primary bg-primary"><?php echo "0";?></span></h4>
                 </div>
               </div>
             </div>
             <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                 <div class="card-body">
                   <h4><i class="fa fa-user"></i> Active Users   <span class="badge badge-success bg-success"><?php echo $enrolls ??"0";?></span></h4>
                 </div>
               </div>
             </div>
             <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                 <div class="card-body">
                   <h4><i class="fa fa-user"></i> Inactive Users  <span class="badge badge-warning text-light bg-warning"><?php echo $centres ?? "0";?></span></h4>
                 </div>
               </div>
             </div>
           </div>
         </div>

         <div class="container">
           

           <div class="card shadow-sm bg-white p-1">
              <div class="card-body">
                <h6 class="text-dark"><i class="fa fa-eye"></i> View Activity Logs</h6>
                <hr/>


                <!-- Start of Form -->
                <table id="table" class="table table-hover table-striped table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th>SR#</th>
                      <th>Activity Name</th>
                      <th>Created By</th>
                      <th>Created At</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php

                        require_once 'classes/Activity.php';
                        $activity = new Activity();
                        $getActivites = $activity->getActivity();
                        $a = 0;
                        while($row  = mysqli_fetch_assoc($getActivites)) {
                            ?>
                            <tr>
                              <td><?php echo ++$a ?></td>
                              <td><?php echo $row['activity_name'] ?></td> 
                               <td><?php echo $row['username'] ?></td> 
                                <td><?php echo $row['created_at'] ?></td> 
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
        <!-- End of Content -->



      </div>
  </div>
 <!-- End of Main Body -->



<!-- Start of Footer -->
<?php   require_once 'includes/footer.php'; ?>
<!-- End of Footer