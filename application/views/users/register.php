<section class="signup_section"><br>
	<div class="card row shadow-lg p-6 mb-5 bg-white rounded" id="signup_box">

		<div class="col-sm-12 col-md-12 col-lg-12 container text-center" id="signup_form">
			<h1 class="card-header" style="border: none;background-color: white">Signup!</h1>
			<div class="container" style="width: 80%;">
			<div class="card-body">
				<?php echo form_open_multipart('users/register'); ?>

					<div class="form-row">
						<div class="form-group col-md-12 col-lg-6">
							<input type="text" class="form-control" name="signup_username" id="signup_username" placeholder="Username" required autofocus>
						</div>

						<div class="form-group col-md-12 col-lg-6">
							<input type="email" class="form-control" name="signup_email" id="signup_email" placeholder="email" required>
						</div>

					</div>

					<div class="form-row">


						<div class="form-group col-md-12 col-lg-6">
							<input type="password" class="form-control" name="signup_password" id="signup_password" placeholder="Password" required>
						</div>

						<div class="form-group col-md-12 col-lg-6">
							<input type="password" class="form-control" name="signup_confirm_password" id="signup_confirm_password" placeholder="Repeat Password" required>
						</div>

					</div>

					<div class="form-row">
						<div class="form-group col-md-12">
							<textarea rows="2" class="form-control" name="signup_bio" id="signup_bio" placeholder="Bio" required></textarea>
						</div>
					</div>

					<div class="form-row">
						<div class="custom-file col-md-12">
						  <input type="file" class="custom-file-input" id="customFile" name="userfile" size="20">
						  <div class="container text-left">
						  		<label class="custom-file-label" for="customFile" style="color: grey;">Profile Pic</label>
						  </div>
						</div>
					</div>


					</div>		
					<div class="card-footer" style="border: none;background-color: white">
						<button type="submit" class="btn btn-block btn-primary shadow">Signup</button>
						
					
				<?php echo form_close(); ?><br>
				
				<?php echo validation_errors('<p id="error_p" class="alert alert-danger">', '</p>'); ?>

				<p><a href="<?php echo base_url(); ?>users/login" class="form-text badge badge-pill badge-light" style="color: #222; font-size: 15px;text-decoration: none;">Have an Account?</a></p>	
				</div>
			</div>	
			</div>
		</div>

	</div><br>
</section>