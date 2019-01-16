<section id="create_post_section"><br>
<!-- category create div -->

<div id="create_category_form" class="container" style="width: 50%;display: none">
<div  class="card shadow text-center container col-md-12 col-lg-12" style="margin: auto"><br>
<div class="container" style="width: 80%;">

		<p class="h5">Create Category!</p><br>
		<?php echo form_open_multipart('categories/create'); ?>
			<input type="text" name="category_name" placeholder="Enter a category name" class="form-control" required><br>
			<span><button type="submit" name="create_post_btn" class="btn btn-success shadow">Create</button>
			<button class="btn btn-secondary category_form_close_btn shadow">Close</button></span><br>
		<?php echo form_close(); ?>
		<?php echo validation_errors('<p id="error_p" class="alert alert-danger">', '</p>'); ?>
		<br>

</div>
</div><br>
</div>

<div class="card container text-center row shadow-lg p-6 mb-5 bg-white rounded" id="create_post_box">
<h1 class="card-header" style="border: none;background-color: white;margin: 5px">Create!</h1>
	<div class="container" style="width: 90%;">
		<div class="card-body">
		<?php echo form_open_multipart('posts/create'); ?>

				<div class="form-row">

						<div class="form-group col-md-12 col-lg-6">
							<input type="text" class="form-control" name="post_title" id="signup_username" placeholder="Title" required autofocus>
						</div>

						<div class="custom-file col-md-12 col-lg-6" style="margin-bottom: 10px">

								<input type="file" class="custom-file-input" id="customFile" name="userfile" size="20">
							
								<div class="container text-left">
											<label class="custom-file-label" for="customFile" style="color: grey;">Upload Image</label>
								</div>

						</div><br><br><br>

						

				</div>

				<div class="form-row">

				<div class="input-group col-md-6 col-lg-9">
							<!-- category field -->
							<select name="post_category" class="custom-select" id="inputGroupSelect02">

							<!-- fetch category names from database -->
							<?php foreach ($categories as $category): ?>
								<option value="<?php echo $category['pencil_db_categories_id']; ?>"><?php echo $category['pencil_db_categories_name']; ?></option>
							<?php endforeach;?>
								
							</select>			
				</div>

				<div class="col-md-6 col-lg-3" style="color: white; margin-bottom: 10px;">
						<a class="btn btn-info shadow d-flex category_create_btn justify-content-center" style="height: 3em;">Add Category</a>
					</div>

				</div>

				<!-- body field -->
				<div class="row">
						<div class="col-md-12 col-lg-12">
							<textarea id="ckeditor_textarea" class="materialize-textarea" name="post_body" required></textarea>
						</div>
				</div>			
						
		</div>
			<!-- submit button (it is a floating button so it has more classes from materializecss)-->
			<div class="card-footer">
						<button type="submit" id="create_post_btn" name="create_post_btn" class="btn btn-primary btn-block shadow">Create</button>
			</div><br>

		<?php echo form_close(); ?>	
	</div>
</div>
</section>

