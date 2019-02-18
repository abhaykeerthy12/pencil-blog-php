<br>
<section id="change_pwd_card">
  <div class="container">
    <div class="card p-3 m-5 shadow-lg animated flipInX">
      <h3 class="text-center m-3"><?=$title;?></h3><br>
      <div class="container pr-5 pl-5">
		<?php echo form_open('users/change_password'); ?>
          <div class="form-group">
			      <input type="password" placeholder="Old Password" class="form-control" name="old_password" autofocus required>
          </div>
          <div class="form-group">
			      <input type="password" placeholder="New Password" class="form-control" name="new_password" required>
          </div>
          <div class="form-group">
			      <input type="password" name="new_password_confirm" class="form-control" placeholder="Confirm Password" required>
          </div>
	    </div>
	    <div class="card-footer d-flex justify-content-center">
		    <button type="submit" name="button" class="btn btn-primary  p-2  rounded-circle shadow-lg"><i class="fas m-1 fa-3x fa-check-circle"></i></button>
	    </div>
		<?php echo form_close(); ?>
  		<?php echo validation_errors('<p id="error_p" class="alert alert-danger text-center mr-5 ml-5">', '</p>'); ?>
    </div>
  </div>
</section>
<br><br><br>