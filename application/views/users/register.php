<br><br>

<!-- page starts -->

<div id="create_card" class="card center container z-depth-5">
	<!-- title -->
	<h2 class="center-align"><?=$title?></h2>
	<div class="row">
	<?php echo form_open_multipart('users/register'); ?>

	<div class="col s12">
		<div class="row">
				<!-- name field -->
			    <div class="input-field col s12">
			      <input type="text" id="signup_name" name="signup_name" autofocus required>
			      <label for="signup_name">Name</label>
				</div>
		</div>
	</div>

	<div class="col s12">
		<div class="row">
				<!-- emailfield -->
			    <div class="input-field col s12">
			      <input type="email" name="signup_email" id="signup_email" required>
			      <label for="signup_email">Email</label>
				</div>
		</div>
	</div>

	<div class="col s12">
		<div class="row">
				<!-- username field -->
			    <div class="input-field col s12">
			      <input type="text" name="signup_username" id="signup_username" required>
			      <label for="signup_username">Userame</label>
				</div>
		</div>
	</div>

	<div class="col s12">
		<div class="row">
				<!-- password field -->
			    <div class="input-field col s12">
				  <input type="password" name="signup_password" id="signup_password" required>
			      <label for="signup_password">Password</label>
				</div>
		</div>
	</div>

	<div class="col s12">
		<div class="row">
				<!-- confirm password field -->
			    <div class="input-field col s12">
			      <input type="password" name="signup_confirm_password" id="signup_confirm_password" required>
			      <label for="signup_confirm_password">Confirm password</label>
				</div>
		</div>
	</div>

	<div class="row">
	<div class="col s12">
			<!-- image upload field -->
			<div class="file-field input-field">
			<div class="btn deep-purple waves-effect waves-light">
					<span>Profile Pic</span>
					<input type="file" name="userfile" size="20">
			</div>
			<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload a profile picture">
			</div>
			</div>
		</div>
	</div>        
		        
	<a class="center black-text" href="<?php echo base_url(); ?>users/login">Already a member?</a>

	<!-- submit button (it is a floating button so it has more classes from materializecss)-->
	<button type="submit" name="create_post_btn" class="btn-floating btn-large halfway-fab waves-effect waves-light deep-purple z-depth-5"><i class="fab fa-telegram-plane"></i></button>

	<?php echo form_close(); ?>
	</div>

	<!-- show errors -->
	<?php echo validation_errors('<p id="error_p" class="red lighten-3 center-align">', '</p>'); ?>
	<br>

</div>
<br>