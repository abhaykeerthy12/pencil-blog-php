<br>
<section class="container card shadow-lg" id="login_div">
<!-- row starts -->
<div class="row">
<!-- login from -->
<div class="col-lg-6 p-5"><br>
  <h1 class="text-center animated lightSpeedIn">Login!</h1><br><br>
  <!-- form starts -->
  <?php echo form_open('users/login'); ?>
  <div class="form-group">
  	<!-- email input -->
    <input type="text" name="login_email" placeholder="Email" class="form-control" autofocus required><br>
	<!-- password input -->
    <input type="password" name="login_password" value="" placeholder="Password" class="form-control" required><br>
    <div class="d-flex justify-content-center">
	<!-- the submit button -->
    <button type="submit" name="button" id="btn2" class="btn rounded-circle shadow-lg mt-3 btn-primary"><i class="fas fa-2x m-1 fa-chevron-right"></i></button>
  </div>
  <?php echo form_close(); ?><br>
  <!-- form ends and pave way for errors -->
  <?php echo validation_errors('<p id="error_p" class="alert alert-danger">', '</p>'); ?>
  </div>
</div>
<!-- login form ends -->

<!-- sigup page advertisement -->
<div class="col-lg-6" id="login_img">
<div class="d-flex justify-content-center">
  <div class="pic_text text-center">
    <h3 class="animated slow slideInDown">New here?, Become a member!</h3>
    <div  class="animated  slideInUp">
    <p>Share your creations with the world!</p>
    <a href="<?php echo base_url(); ?>users/register" class="btn btn-primary shadow-lg"><strong>Sign Up!</strong></a>
   </div>
  </div>
</div>
</div>
<!-- signup page advertisement ends -->
</div>
<!-- row ends -->
</section>
<br><br>