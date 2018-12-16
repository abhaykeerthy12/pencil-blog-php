<br><br>

<!-- the edit page starts -->

<!-- page title -->
<div id="edit_card" class="card container z-depth-5">
	<h4><?=$title;?></h4><br>
<div class="row">

<!-- form starts -->
<?php echo form_open_multipart('users/update'); ?>

	<!-- this hidden field is to get posts id for updating -->
	<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">

	<!-- name field -->
	<div class="col s12">
		<div class="row">
			<p>&nbsp&nbsp&nbspName</p>
		    <div class="input-field col s12">
		      <!-- show previous name from database to filed -->
		      <input type="text" name="user_name" value="<?php echo $this->session->userdata('user_name'); ?>" required autofocus>
		</div>
	</div>
  </div>

  <!-- username field -->
	<div class="col s12">
		<div class="row">
			<p>&nbsp&nbsp&nbspUsername</p>
		    <div class="input-field col s12">
		      <!-- show previous username from database to filed -->
					<input type="text" name="user_username" value="<?php 	
					$s = $this->session->userdata('user_username');					
					echo substr($s, 1);?>" required autofocus>
		</div>
	</div>
  </div>

	<!-- bio field -->
	<div class="row">
		    <div class="input-field col s12">
		      <textarea id="signup_bio" class="materialize-textarea" name="user_bio" required><?php echo $this->session->userdata('user_bio'); ?></textarea>
					<label for="signup_bio">Bio</label>
		    </div>
	</div>

  <!-- email field -->
	<div class="col s12">
		<div class="row">
			<p>&nbsp&nbsp&nbspEmail</p>
		    <div class="input-field col s12">
		      <!-- show previous email from database to filed -->
		      <input type="text" name="user_email" value="<?php echo $this->session->userdata('user_email'); ?>" required autofocus>
		</div>
	</div>
  </div>

	<input type="hidden" name="userfile1" size="20" value="<?php echo $this->session->userdata('user_image'); ?>">

	<!-- image upload field -->
	<div class="row">
	<div class="col s12">
	<div class="file-field input-field">
		      <div class="btn deep-purple waves-effect waves-light">
		        <span>Profile Pic</span>
		        <input type="file" name="userfile" size="20">
		      </div>
			  <div class="file-path-wrapper">
			    <input class="file-path validate" type="text" placeholder="Tap to select profile pic">
			  </div>
   </div>
	 </div>
	 </div>

	<div class="center"><a href="<?php echo base_url(); ?>users/change_password/<?php echo $this->session->userdata('user_id'); ?>" class="black-text"><p class="chip">change password?</p></a><span><br><br><em>You will be logged out for the changes to take effect</em></span></div>

	<!-- the submit button (it is a floating button so it has more classes from materializecss) -->
	<button type="submit" name="edit_post_btn" class="btn-floating btn-large halfway-fab waves-effect waves-light deep-purple z-depth-5"><i class="fas fa-plus"></i></button>
	</div>

</form>
<!-- form ends -->
</div>
	<!-- show errors -->
	<?php echo validation_errors('<p id="error_p" class="red lighten-3 center-align">', '</p>'); ?>
	<br>
</div>

<!-- page ends -->
<br>
<br>
	<div class="container">
	<div id="delete_bar" class="card red accent-3 container z-depth-5">
		<a href="<?php echo base_url(); ?>users/self_distruct" class="black-text"><h5 class="center-align white-text">Delete account</h5></a>
	</div>
</div>
<br>