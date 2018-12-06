<br><br>

<!-- page starts -->

<div id="create_card" class="card container z-depth-5">
	<!-- title -->
	<h4 class="center-align"><?=$title;?></h4><br>

<!-- form starts (it is multipart because in case we pass category images in future)-->
<div class="row container">
	<?php echo form_open_multipart('categories/create'); ?>
		<div class="col s12">
			<div class="row">
					<!-- name field -->
				    <div class="input-field col s12">
				      <input id="category_name" type="text" name="category_name" autofocus>
					  <label for="category_name">Category name</label>
					</div>
			</div>
			<a href="<?php echo base_url(); ?>categories" class="black-text">
				<p class="center-align">Before creating, Confirm whether your desired category exists or not!</p>
			</a>
			<button type="submit" name="create_post_btn" class="btn-floating btn-large halfway-fab waves-effect waves-light deep-purple z-depth-5"><i class="fas fa-plus"></i></button>
		</div>
	<?php echo form_close(); ?>
</div>
	<!-- show errors -->
	<?php echo validation_errors('<p id="error_p" class="red lighten-3 center-align">', '</p>'); ?>
	<br>
</div>

