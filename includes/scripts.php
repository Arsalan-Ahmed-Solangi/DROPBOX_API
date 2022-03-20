<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Jquery Cdn -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Jquery Form Validation Cdn -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<!-- Datatable Js   Cdn-->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Datatable Bootstrap 5 Cdn -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- Sweet Alert Js -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Start of Toggle Menu -->
 <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
<!-- End of Toggle Menu -->

<!-- Custom Scripts -->
<script type="text/javascript">
	$(document).ready(function(){

		 $(".alert").delay(1000).fadeOut(2000);

		 $("#form").validate();

		//Form Validation
		$("#validate").validate({


			submitHandler: function(form) {


			 var email = $("#email").val();	
			 var password = $("#password").val();	
			   
			  //*****Start of Form Ajax Request***********//
			   $.ajax({
		            url: 'process.php',
		            type: 'POST',
		            dataType: 'JSON',
		            data: {
		            	email : email,
		            	password : password,
		            	action : 'login'
		            },
		            success: function(response) {
		               
		               if(response.status == 1)
		               {	

		               		Swal.fire(
							  'Login Successfull',
							  'You are redirecting to your panel',
							  'success'
							)

		               		//****Redirecting to the Admin Panel*******//
		               		 setTimeout(function(){ 
							    window.location.href = 'home.php';
							}, 1000);
		               		

		               }else if(response.status == 0)
		               {
   	               	        Swal.fire({
							  icon: 'error',
							  title: 'You account is inactive',
							  footer: '<a href="index.php">Contact Admin : ahmedsolang347@gmail.com</a>'
							})
		               	
		               }else if(response.status == 2)
		               {
   	               	        Swal.fire({
							  icon: 'error',
							  title: 'Invalid Credentials',
							  text : 'Try Again!'
							})
		               	
		               }
		            }            
		        });
		      //****End of Login Form Ajax Request *************//  
			}

		});

		//Datatable 
		$("#table").DataTable({
			dom: 'Bfrltip',
		        buttons: [
		            {
		                extend: 'csv',
		                split: [ 'pdf', 'excel'],
		            }
		        ]

		});


		//*****Start of User Ajax**********//
       function loadData()
       {
	       	$.ajax({

	       		'url' : 'process.php',
	       		'data':{
	       			action : "getUsers",
	       		},
	       		success: function(response) {
	       			$("#table-body").append(response);
	       		}

	       })
       }
       loadData();
		//*****End of User Ajax*********//




		//***Start of Add User************///
		$("#addUser").validate({


			submitHandler: function(form) {


			 var email = $("#email").val();	
			 var password = $("#password").val();	
			   
			  //*****Start of Form Ajax Request***********//
			   $.ajax({
		            url: 'process.php',
		            type: 'POST',
		            dataType: 'JSON',
		            data: {
		            	email : email,
		            	password : password,
		            	action : 'addUser'
		            },
		            success: function(response) {
		               

		               if(response.status == 1)
		               {	

		               		Swal.fire(
							  'Good Job',
							  'User Added Successfully!',
							  'success'
							)
		               		//****Redirecting to the Admin Panel*******//

		               		loadData();
		               		  $('#exampleModal').modal('toggle');
		               		

		               }else if(response.status == 0)
		               {
   	               	        Swal.fire({
							  icon: 'error',
							  title: 'Something went wrong tryagain!',
							  footer: '<a href="index.php">Contact Admin : ahmedsolang347@gmail.com</a>'
							})
		               	
		               }
		            }            
		        });
		      //****End of Login Form Ajax Request *************//  
			}

		});

		//****End of Add User*************//






		

	});

	//***Start of Edit User************///
	$(document).on('click','#update',function(e) {

		 function loadData()
       {
	       	$.ajax({

	       		'url' : 'process.php',
	       		'data':{
	       			action : "getUsers",
	       		},
	       		success: function(response) {
	       			$("#table-body").empty();
	       			$("#table-body").append(response);
	       		}

	       })
       }
      

		var data = $("#editUser").serialize();
		$.ajax({
			data: data,
			type: "post",
			dataType : 'json',
			url: "process.php",
			success: function(response){
				
				if(response.status == 1)
               {	


               		loadData();
               		$('#editModel').modal('toggle');
               		Swal.fire(
					  'Good Job',
					  'User Updated Successfully!',
					  'success'
					)
               		//****Redirecting to the Admin Panel*******//

               		

               }else if(response.status == 0)
               {
               	        Swal.fire({
					  icon: 'error',
					  title: 'Something went wrong tryagain!',
					  footer: '<a href="index.php">Contact Admin : ahmedsolang347@gmail.com</a>'
					})
               	
               }

			}
		});
	});
		//****End of Edit User*************//

	$(document).on('click','.update',function(e) {
			
			var id=$(this).attr("data-id");
			var email=$(this).attr("data-email");
			var password=$(this).attr("data-password");
			var status=$(this).attr("data-status");
			$('#id_u').val(id);
			$('#email_u').val(email);
			$('#password_u').val(password);
			
			if(status == "Active")
			{
				$("#active").attr('selected','selected');
			}else if(status == "Inactive")
			{
                $("#inactive").attr('selected','selected');
			}

	});

	//***Start of Delete User********//
	$(document).on("click", ".delete", function() { 
		var id=$(this).attr("data-id");
		$('#id_d').val(id);
		
	});

	$(document).on("click", "#delete", function() {

		 function loadData()
       {
	       	$.ajax({

	       		'url' : 'process.php',
	       		'data':{
	       			action : "getUsers",
	       		},
	       		success: function(response) {
	       			$("#table-body").empty();
	       			$("#table-body").append(response);
	       		}

	       })
       }

		$.ajax({
			url: "process.php",
			type: "POST",
			dataType : "json",
			cache: false,
			data:{
	
				id: $("#id_d").val(),
				action :"deleteUser",
			},
			success: function(response){

					$('#deleteModel').modal('hide');
					loadData()
			
			}
		});
	});
	//**End of Delete User **********//
</script>

