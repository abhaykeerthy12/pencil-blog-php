<section id="edit_post_section"><br>

<div class="card container text-center row shadow-lg p-6 mb-5 bg-white rounded" id="create_post_box">
<h1 class="card-header" style="border: none;background-color: white;margin: 5px">Edit!</h1>
	<div class="container" style="width: 90%;">
		<div class="card-body">
		<?php echo form_open_multipart('posts/update'); ?>
		

		<!-- this hidden field is to get posts id for updating -->
		<input type="hidden" name="post_id" value="<?php echo $post['pencil_db_posts_id']; ?>">

				<div class="form-row">

						<div class="form-group col-md-12 col-lg-6">
							<input type="text" class="form-control" name="post_title" value="<?php echo $post['pencil_db_posts_title']; ?>" placeholder="Title" required autofocus>
						</div>
						
						<input type="hidden" name="userfile1" size="20" value="<?php echo $post['pencil_db_posts_post_image']; ?>">
						<div class="custom-file col-md-12 col-lg-6" style="margin-bottom: 10px">

								<input type="file" class="custom-file-input" id="customFile" name="userfile" size="20">
							
								<div class="container text-left">
											<label class="custom-file-label" for="customFile" style="color: grey;">Upload Image</label>
								</div>

						</div><br><br><br>

						

				</div>

				<div class="form-row">

				<div class="input-group col-md-12 col-lg-12">
							<!-- category field -->
							<select name="post_category" class="custom-select" id="inputGroupSelect02">

							<!-- set to previous category if no change -->
							<option value="<?php echo $post['pencil_db_posts_category_id']; ?>" selected>Choose a Category</option>

							<!-- fetch category names from database -->
							<?php foreach ($categories as $category): ?>
								<option value="<?php echo $category['pencil_db_categories_id']; ?>"><?php echo $category['pencil_db_categories_name']; ?></option>
							<?php endforeach;?>
								
							</select>			
				</div>

				</div>

				<!-- body field -->
				<div class="row">
						<div class="col-md-12 col-lg-12">
							<textarea id="ckeditor_textarea" class="materialize-textarea" name="post_body" required><?php echo $post['pencil_db_posts_body']; ?></textarea>
						</div>
				</div>			
						
		</div>
			<!-- submit button (it is a floating button so it has more classes from materializecss)-->
			<div class="card-footer">
						<button type="submit" id="create_post_btn" name="edit_post_btn" class="btn btn-primary btn-block shadow">Create</button>
			</div><br>

		<?php echo form_close(); ?>	
	</div>
</div>
</section>

