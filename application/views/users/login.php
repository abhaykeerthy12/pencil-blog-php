<section class="login_section"><br><br>
	<div class="row container shadow-lg p-3 mb-5 bg-white rounded" id="login_box">

		<div class="col-sm-12 col-md-12 col-lg-6 container" id="login_pic">
			<img data-tilt src="<?php echo base_url(); ?>/assets/images/images/login.png" class="img-fluid" >
		</div>
		<div class="col-sm-12 col-md-12 col-lg-6 container text-center" id="login_form"><br>
			<h1>Login!</h1><br>
			<div class="container" style="width: 80%;">
				<?php echo form_open('users/login'); ?>
					<div class="form-group">
						<input type="email" class="form-control" id="login_email" name="login_email" placeholder="email" required autofocus><br>
						<input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password" required><br>
						<button type="submit" class="btn btn-block btn-primary shadow">Login</button>
					</div>			
				<?php echo form_close(); ?><br>
					<?php echo validation_errors('<p id="error_p" class="alert alert-danger">', '</p>'); ?>

				<p><a href="<?php echo base_url(); ?>users/register" class="form-text badge badge-pill badge-light" style="color: #222; font-size: 15px;text-decoration: none;">Need an Account?</a></p>		
			</div>
		</div>
		
	</div><br><br>
</section>
