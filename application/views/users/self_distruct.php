<br><br>

<!-- page starts -->

<div id="create_card" class="card center container z-depth-5">
	<!-- title -->
	<h4 class="center-align"><?=$title;?></h4><br>
	<div class="row">
	<?php echo form_open('users/self_distruct'); ?>

	<div class="col s12">
		<div class="row">
				<!-- password field -->
			    <div class="input-field col s12">
			      <input type="password" id="confirm_password" name="confirm_password" autofocus>
			      <label for="confirm_password">Password</label>
				</div>
		</div>
  </div>
  
	<!-- submit button (it is a floating button so it has more classes from materializecss)-->
	<button type="submit" name="create_post_btn" class="btn-floating btn-large halfway-fab waves-effect waves-light deep-purple z-depth-5"><i class="fab fa-telegram-plane"></i></button>

	<?php echo form_close(); ?>
	</div>

	<!-- show errors -->
	<?php echo validation_errors('<p id="error_p" class="red lighten-3 center-align">', '</p>'); ?>
	<br>

</div>
