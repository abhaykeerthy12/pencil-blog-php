<br><br>

<!-- page starts -->

<div id="create_card" class="card center container z-depth-5">
	<!-- title -->
	<h4 class="center-align"><?=$title;?></h4><br>
	<div class="row">
	<?php echo form_open('users/login'); ?>

	<div class="col s12">
		<div class="row">
				<!-- email field -->
			    <div class="input-field col s12">
			      <input type="email" id="login_email" name="login_email" autofocus>
			      <label for="login_email">Email</label>
				</div>
		</div>
	</div>
	<div class="col s12">
		<div class="row">
				<!-- password field -->
			    <div class="input-field col s12">
			      <input type="password" id="login_password" name="login_password">
			      <label for="login_password">Password</label>
				</div>
		</div>
	</div>
	<a class="center black-text chip" href="<?php echo base_url(); ?>users/register">Need an account?</a>

	<!-- submit button (it is a floating button so it has more classes from materializecss)-->
	<button type="submit" name="create_post_btn" class="btn-floating btn-large halfway-fab waves-effect waves-light deep-purple z-depth-5"><i class="fab fa-telegram-plane"></i></button>

	<?php echo form_close(); ?>
	</div>

	<!-- show errors -->
	<?php echo validation_errors('<p id="error_p" class="red lighten-3 center-align">', '</p>'); ?>
	<br>

</div>
