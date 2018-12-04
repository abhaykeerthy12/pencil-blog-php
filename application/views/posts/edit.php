<br><br>

<!-- the edit page starts -->

<!-- page title -->
<div id="edit_card" class="card container z-depth-5">
	<h4><?=$title;?></h4><br>
<div class="row">

<!-- form starts -->
<?php echo form_open_multipart('posts/update'); ?>

	<!-- this hidden field is to get posts id for updating -->
	<input type="hidden" name="post_id" value="<?php echo $post['pencil_db_posts_id']; ?>">

	<!-- title field -->
	<div class="col s12">
		<div class="row">
			<p>&nbsp&nbsp&nbspTitle</p>
		    <div class="input-field col s12">
		      <!-- show previous title from database to filed -->
		      <input type="text" name="post_title" value="<?php echo $post['pencil_db_posts_title']; ?>" required autofocus>
		</div>
	</div>
	<!-- category field -->
	<div class="row">
	<p>&nbsp&nbsp&nbspCategory</p>
	<div class="input-field col s12">

	<select name="post_category">
		<!-- set to previous category if no change -->
		<option value="<?php echo $post['pencil_db_posts_category_id']; ?>" selected>Choose a Category</option>

		<!-- fetch categories from database -->
	  	<?php foreach ($categories as $category): ?>
	  	<option
	  	value="<?php echo $category['pencil_db_categories_id']; ?>"><?php echo $category['pencil_db_categories_name']; ?></option>
	    <?php endforeach;?>

	</select>

	</div>
	</div>

	<input type="hidden" name="userfile1" size="20" value="<?php echo $post['pencil_db_posts_post_image']; ?>">

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

		 <!-- show previous body from database to filed -->
	     <textarea id="ckeditor_textarea" class="materialize-textarea" name="post_body" required><?php echo $post['pencil_db_posts_body']; ?></textarea>

	    </div>
	</div>

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
