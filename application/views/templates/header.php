<html>
	<head>
		<title>Pencil</title>
		<script src="<?php echo base_url(); ?>/assets/js/jquery/jquery-3.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/js/materialize/materialize.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/materialize/materialize.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/font_awesome/css/all.css">
		<script src="<?php echo base_url(); ?>/assets/js/index.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>/assets/ckeditor/ckeditor.js"></script>
	</head>
	<body>
		<!-- create a side navbar -->
		<header class="deep-purple">
		<ul id="slide-out" class="sidenav sidenav-fixed deep-purple darken-2 z-depth-5">
			<!-- title -->
			<li><div class="user-view">
		        <a href="<?php echo base_url(); ?>"><span class="white-text name"><h1 id="head_title_pencil">&nbspPencil</h1></span></a>
			    </div></li>
			    <!-- show other page links -->

			    <!-- home -->
			    <li><a class="white-text waves-effect" href="<?php echo base_url(); ?>">Home</a></li>
			    <!-- blog -->
			    <li><a class="white-text waves-effect" href="<?php echo base_url(); ?>posts">Blog</a></li>
			    <!-- categories -->
			    <li><a class="white-text waves-effect" href="<?php echo base_url(); ?>categories">Categories</a></li>
			    <!-- about -->
			    <li><a class="white-text waves-effect" href="<?php echo base_url(); ?>about">About</a></li>

			    <!-- here comes the twist, if any user is logged in, show create stuff links and logout option-->
			    <?php if ($this->session->userdata('logged_in')): ?>
			   	<ul class="collapsible collapsible-accordion">
		          <li>
		          	<!-- just collapse title -->
		            <a class="collapsible-header white-text waves-effect">&nbsp&nbsp&nbsp&nbspCreate</a>
		            <div class="collapsible-body">
		              <ul>
		              	<!-- create category -->
		              	<li><a class="white-text deep-purple lighten-1 waves-effect " href="<?php echo base_url(); ?>categories/create">Create Category</a></li>
		              	<!-- create post -->
		                <li><a class="white-text deep-purple lighten-1 waves-effect" href="<?php echo base_url(); ?>posts/create">Create Post</a></li>
		              </ul>
		            </div>
		          </li>
		        </ul>
				<?php if ($this->session->userdata('is_admin') == 'yes') {

    echo "<li><a class='white-text waves-effect' href=" . base_url() . "users/admin>Admin</a></li>";

}
?>
		        <!-- logout -->
			    <li><a class="white-text waves-effect" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
				<?php endif;?>

				<!-- if no-one is logged in show register and login link, let them choose! -->
		        <?php if (!$this->session->userdata('logged_in')): ?>
			    	<li><a class="white-text waves-effect" href="<?php echo base_url(); ?>users/login">Login</a></li>
			    	<li><a class="white-text waves-effect" href="<?php echo base_url(); ?>users/register">Signup</a></li>
				<?php endif;?>

		</ul>
		<!-- handburger menu when a small screen size is detected -->
		<a href="" data-target="slide-out" class=" btn btn-large waves-effect waves-light deep-purple sidenav-trigger hide-on-large-only"><i class="fas fa-bars"></i></a>

		</header>
		<!-- container div starts -->
		<main>
		<div class="container">

		<!-- flash messages with toast effect(its cool!!!) -->
		<!-- i know its not DRY code, i'll change it soon -->

		<?php
if ($this->session->flashdata('post_created')) {
    echo "
		      <script>
		         M.toast({html: 'Post Created!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('user_registered')) {
    echo "
		      <script>
		         M.toast({html: 'You are now a member, Login!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('post_updated')) {
    echo "
		      <script>
		         M.toast({html: 'Post Updated!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('login_failed')) {
    echo "
		      <script>
		         M.toast({html: 'Login Invalid!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('category_created')) {
    echo "
		      <script>
		         M.toast({html: 'Category created!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('post_deleted')) {
    echo "
		      <script>
		         M.toast({html: 'Post deleted!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('user_loggedin')) {
    echo "
		      <script>
		         M.toast({html: 'Logged In!', classes: 'rounded'});
		      </script>";
}
?>


		<?php
if ($this->session->flashdata('user_loggedout')) {
    echo "
		      <script>
		         M.toast({html: 'Logged Out!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('category_deleted')) {
    echo "
		      <script>
		         M.toast({html: 'Category deleted!', classes: 'rounded'});
		      </script>";
}
?>

		<?php
if ($this->session->flashdata('user_deleted')) {
    echo "
		      <script>
		         M.toast({html: 'User deleted!', classes: 'rounded'});
		      </script>";
}
?>


