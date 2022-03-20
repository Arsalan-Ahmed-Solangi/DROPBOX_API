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
                <li class="breadcrumb-item"><i class="fa fa-users"></i> <a class="text-dark" href="users.php" style="text-decoration: none;">Users </a> | <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add_btn"><i class="fa fa-plus-circle"></i> Add User </button> </li>
              </ol>
            </nav>


            <div class="card shadow-sm bg-white p-1">
              <div class="card-body">
                <h6 class="text-dark"><i class="fa fa-eye"></i> View All Users</h6>
                <hr/>

                <!-- Start of Table -->
                <table id="getUsers" class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>sr</th>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody id="table-body">
                    
                  </tbody>
                </table>
                <!-- End of Table -->

              </div>
            </div>
        </div>
        <!-- End of Container -->


        <!-- Start of Add User Model -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form id="addUser">
                <div class="modal-body">
                    <div class="form-group mb-2">
                      <label>Email <span class="text-danger">*</span></label>
                      <input type="email" id="email" name="email" class="form-control" required placeholder="Enter your email">
                    </div>

                    <div class="form-group mb-2">
                      <label>Password <span class="text-danger">*</span></label>
                      <input type="password" name="password" id="password" required class="form-control" placeholder="Enter your password">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                  <button type="submit" class="btn btn-primary" id="model-button"><i class="fa fa-plus"></i> Add</button>
                </div>
                </form>
            </div>
          </div>
        </div>
        <!-- End of Add User Model-->

         <!-- Start ofEdit  User Model -->
        <div id="editModel" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="editUser">
              <div class="modal-header">            
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit User</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" id="id_u" name="user_id" class="form-control" required>         
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" id="email_u" name="email_u" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Password <span class="text-danger">*</span></label>
                  <input type="password" id="password_u" name="password_u" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Status <span class="text-danger">*</span></label>
                  <select name="status" required class="form-select">
                    <option value="">--SELECT STATUS--</option>
                    <option value="Active" id="active">Active</option>
                     <option value="Inactive" id="inactive">Inactive</option>
                  </select>
                </div>
                <input type="hidden" name="action" value="editUser">          
              </div>
              <div class="modal-footer">
              <input type="hidden" value="2" name="type">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                <button type="button" class="btn btn-success" id="update"><i class="fa fa-edit"></i> Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
        <!-- End ofEdit  User Model-->


        <!-- Start of Delete Model -->
        <div id="deleteModel" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form>
                <div class="modal-body">
                  <input type="hidden" id="id_d" name="id" class="form-control">   
                  <h5 align="center"><i class="fa fa-trash fa-3x text-danger"></i></h5>       
                  <p align="center">Are you sure you want to delete these Records?</p>
                  <p class="text-success" align="center"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                  <button type="button" class="btn btn-danger" id="delete">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End of Delete Model -->

      </div>
  </div>
<!-- End of Main Body -->



<!-- Start of Footer -->
<?php   require_once 'includes/footer.php'; ?>
<!-- End of Footer