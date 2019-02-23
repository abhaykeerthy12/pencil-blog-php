<html>
	<head>
		<title>Pencil</title>

   	<script src="<?php echo base_url(); ?>/assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/toastr.min.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/fonts/font_awesome/css/all.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/toastr.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/date-picker.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/animate.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/style.css">

	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow">
			<a class="navbar-brand" href="<?php echo base_url(); ?>">Pencil</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
				<a class="nav-link" id="nav_home" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
				<a class="nav-link" id="nav_blog" href="<?php echo base_url(); ?>posts">Blog</a>
				</li>
				<!-- if user is logged in -->
				<?php if($this->session->userdata('logged_in')): ?>
				<li class="nav-item">
				<a class="nav-link" id="nav_create" href="<?php echo base_url(); ?>posts/create">Create</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="nav_profile" href="<?php echo base_url(); ?>users/profile">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="nav_logout" href="<?php echo base_url(); ?>users/logout">Logout</a>
				</li>
				<?php else : ?>
				<li class="nav-item">
					<a class="nav-link" id="nav_login" href="<?php echo base_url(); ?>users/login">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="nav_signup" href="<?php echo base_url(); ?>users/register">Signup</a>
				</li>
				<?php endif; ?>
				</li>
				<li class="nav-item">
				<a class="nav-link" id="nav_about" href="<?php echo base_url(); ?>about">About</a>
				</li>
			</ul>
			<div class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" id="nav_search_box" placeholder="Type Keyword" aria-label="Search">
				<button class="btn btn-dark my-2 my-sm-0 nav_search_btn" type="submit" id="nav-search">Search</button>				
			</div>		
		</div>		
	</nav>
	

<?php

function toastphp($msg, $color){

	echo '<script>
			toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-top-center",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		 </script>';
	
	echo '<script>toastr.'.$color.'("'.$msg.'");</script>';

}
if ($this->session->flashdata('user_logged_in')) 
	toastphp('Logged In', 'success');
if ($this->session->flashdata('login_ban')) 
	toastphp('Your account is deactivated, Contact admin!', 'error');
if ($this->session->flashdata('login_failed')) 	
	toastphp('Login Invalid!', 'error');
if ($this->session->flashdata('user_logged_out')) 
	toastphp('Logged Out!','info');
if ($this->session->flashdata('post_created')) 
	toastphp('Post Created!','success');
if ($this->session->flashdata('user_registered')) 
	toastphp('You are now a member, Login!','success');
if ($this->session->flashdata('post_updated')) 
	toastphp('Post Updated!','success');
if ($this->session->flashdata('old_password_error')) 
	toastphp('Old Password is Wrong!','error');
if ($this->session->flashdata('pwd_error')) 
	toastphp('The Password is Wrong!','error');
if ($this->session->flashdata('comment_deleted')) 
	toastphp('Comment Deleted!','error');

?> 
	
<div id="search_result_box_container">
<div id="search_result_box" class="p-3 blog-body" style="display: none;overflow: hidden;">
	<p class="lead text-center m-5">Field Is Empty, Type Some Keywords!</p>
     <hr><div class='d-flex justify-content-center'><button id='search_box_close' class='btn shadow-lg btn-danger btn-lg'><i class='fas shadow-lg fa-times fa-2x'></i></button></div><br>

</div>
</div>

<main>
  