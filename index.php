<!-- Start of Check Session -->
<?php
            
    session_start();
    if(isset($_SESSION['user']))
    {
        header('location:home.php');
    }        

?>
<!-- End of Check Session -->
<!---Start of Header -->
<?php 
	$title = "Login";
	require_once 'includes/header.php';  
?>
<!-- End of Header -->


 <!-- Start of Main Body -->
 <div class="container" style="margin-top: 100px;">
 	<div class="card shadow-sm bg-white" style="width: 45%; margin: auto;">
 		<div class="card-header bg-dark">
 			<h4 class="text-light text-center"><i class="fa fa-user-cog"></i> User Login</h4>
 		</div>

 		<div class="card-body">

 			<form id="validate">
 				<div class="form-group mb-2">
 					<label>Email <span class="text-danger">*</span></label>
 					<input type="email" name="email" id="email" required class="form-control" placeholder="Enter your email">
 				</div>

 				<div class="form-group mb-2">
 					<label>Password <span class="text-danger">*</span></label>
 					<input type="password" name="password" id="password" required class="form-control" placeholder="Enter your password">
 				</div>

 				<div class="form-group mb-2 text-center">
 					<button id="login" type="submit" class="btn btn-danger text-center"> <i class="fa fa-sign-in"></i> Login</button>
 				</div>
 			</form>
 		</div>
 	</div>
 </div>
 <!-- End of Main Body -->



<!-- Start of Footer -->
<?php   require_once 'includes/footer.php'; ?>
<!-- End of Footer