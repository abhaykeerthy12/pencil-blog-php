<br>
<section class="container card shadow-lg" id="signup_div">
<div class="row">
<!-- login advertisement -->
<div class="col-lg-6" id="signup_img">
  <div class="d-flex justify-content-center">
    <div class="pic_text text-center">
      <h3 class="animated slow slideInDown">Already a member?</h3>
      <div  class="animated  slideInUp">
      <p>Hop on and create!</p>
      <a href="<?php echo base_url(); ?>users/login" class="btn btn-primary shadow-lg" name="button"><strong>Login!</strong></a>
     </div>
    </div>
  </div>
</div>
<!-- login advertisement ends -->

 <div class="col-lg-6">

    <h1 class="text-center animated m-4 lightSpeedIn">Sign Up!</h1>
	<?php echo form_open_multipart('users/register'); ?>
    <div class="form-group row">
      	<!-- Username -->
	    <div class="col-lg-6">
	      <label class="sr-only" for="inlineFormInputGroup">Username</label>
	        <div class="input-group mb-2">
	          <div class="input-group-prepend">
	            <div class="input-group-text">@</div>
	          </div>
	          <input type="text" class="form-control" name="signup_username" id="inlineFormInputGroup" placeholder="Username" required autofocus>
	        </div>
	    </div>
		<!-- email -->
	    <div class="col-lg-6">
	      <div class="input-group">
	        <input type="email" name="signup_email" class="form-control" placeholder="Email" required>
	      </div>
	    </div>
  	</div>
  	<div class="form-group row">
		  <!-- password -->
	      <div class="col-lg-6">
	        <div class="input-group mb-2">
	          <input type="password" name="signup_password" class="form-control" placeholder="Password" required>
	        </div>
	      </div>
		  <!-- confirm password -->
	      <div class="col-lg-6">
	        <div class="input-group">
	          <input type="password" name="signup_confirm_password" class="form-control" placeholder="Repeat Password" required>
	        </div>
	      </div>
    </div>
	<div class="form-group row pr-3 pl-3">
		  <!-- profile pic -->
	   	  <div class="custom-file col-lg-12">
			    <input type="file" class="custom-file-input" id="customFile" name="userfile" size="20">
				<div class="container text-left">
				  <label class="custom-file-label" for="customFile" style="color: grey;">Profile Pic</label>
				</div>
		  </div>
	</div>
	<div class="form-group row">
	  <div class="col-lg-12">
	    <div class="input-group">
	      <textarea name="signup_bio" rows="2" class="form-control" placeholder="Bio"></textarea>
	    </div>
	  </div>
	</div>

	<div class="d-flex justify-content-center m-1 p-1">
		<button type="submit" name="button" class="btn p-2 pl-3 pr-3 rounded-circle shadow-lg m-2 btn-primary">
			<i class="fas m-1 fa-2x fa-plus"></i>
		</button>
	</div>
	<?php echo form_close(); ?><br>				
	<?php echo validation_errors('<p id="error_p" class="alert alert-danger">', '</p>'); ?>

</div>
</div>

</section>
<br><br>

