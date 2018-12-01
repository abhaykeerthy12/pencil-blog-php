<br><br>

<!-- page starts -->

<div id="create_card" class="card container z-depth-5">
	<!-- title -->
	<h4><?=$title;?></h4><br>

<!-- form starts (it is multipart because we are passing image)-->
	<div class="row">
	<?php echo form_open_multipart('posts/create'); ?>
    <div class="col s12">
		<div class="row">
				<p>&nbsp&nbsp&nbspTitle</p>

				<!-- title field -->
			    <div class="input-field col s12">
			      <input type="text" name="post_title" required autofocus>
				</div>
		</div>
		<div class="row">
			<p>&nbsp&nbsp&nbspCategory</p>
			<div class="input-field col s12">

				<!-- category field -->
				<select name="post_category">

				  <!-- fetch category names from database -->
				  <?php foreach ($categories as $category): ?>
				  	<option value="<?php echo $category['pencil_db_categories_id']; ?>"><?php echo $category['pencil_db_categories_name']; ?></option>
				  <?php endforeach;?>

				</select>
				<p style="font-size: 12px;"><a class="black-text right"href="<?php echo base_url(); ?>categories/create">Didn't found desired category?</a></p>
			</div>
			
		</div>

		<!-- image upload field -->
		 <div class="file-field input-field">
		      <div class="btn deep-purple waves-effect waves-light">
		        <span>Image</span>
		        <input type="file" name="userfile" size="20">
		      </div>
			  <div class="file-path-wrapper">
			    <input class="file-path validate" type="text" placeholder="Tap to select an Image">
			  </div>
   		 </div>

		<!-- body field -->
		<div class="row">
			<p>&nbsp&nbsp&nbspBody</p>
		    <div class="input-field col s12">
		      <textarea id="ckeditor_textarea" class="materialize-textarea" name="post_body" required></textarea>
		    </div>
		</div>

		<!-- submit button (it is a floating button so it has more classes from materializecss)-->
		<button type="submit" name="create_post_btn" class="btn-floating btn-large halfway-fab waves-effect waves-light deep-purple z-depth-5"><i class="fas fa-plus"></i></button>

		</div>
	<?php echo form_close(); ?>
	</div>
	<!-- form ends -->

	<!-- show errors -->
	<?php echo validation_errors('<p id="error_p" class="red lighten-3 center-align">', '</p>'); ?>
	<br>

</div>
<!-- page ends -->
<br>
