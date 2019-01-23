<section id="create_post_section"><br>
<!-- category create div -->

<div id="create_category_form" class="container mb-3" style="width: 60%;display: none;">
<div  class="card shadow text-center container col-md-12 col-lg-12" style="margin: auto"><br>
<div class="container" style="width: 90%;">

		<p class="h5 card-header mt-2">Create Category!</p>
		<form id="category_create_form">
			<div class="card-body">
			<input type="hidden" name="page_url" value="<?php echo current_url() ?>">
			<input type="text" id="create_category_name" name="category_name" placeholder="category name" class="form-control" required>
			</div>
			<div class="card-footer"><button type="submit" id="create_category_btn" name="create_category_btn" class="btn btn-success shadow m-3">Create</button>
			<button class="btn btn-secondary category_form_close_btn shadow">Close</button></div>
		</form>
		<?php echo validation_errors('<p id="error_p" class="alert alert-danger">', '</p>'); ?>
		<br>

</div>
</div>
</div>
<div class="card container text-center row shadow-lg p-6 mb-5 bg-white rounded" id="create_post_box">
<h3 class="card-header mt-2 ">Create!</h3>
	<div class="container" style="width: 90%;">
		<div class="card-body">
		<?php echo form_open_multipart('posts/create'); ?>

				<div class="row">

						<div class="form-group col-lg-6">
							<input type="text" class="form-control" name="post_title" id="signup_username" placeholder="Title" required autofocus>
						</div>

						<div class="form-group col-lg-6">
						<div class="custom-file" style="margin-bottom: 10px">

								<input type="file" class="custom-file-input" id="customFile" name="userfile" size="20">
							
								<div class="container text-left">
											<label class="custom-file-label" for="customFile" style="color: grey;">Upload Image</label>
								</div>

						</div>
						</div>						

				</div>

				<div class="row mb-2">

				<div class="input-group col-md-6 col-lg-9">
							<!-- category field -->
							<select name="post_category" class="custom-select" id="list_categories" required></select>			
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
			<div class="card-footer mb-3">
						<button type="submit" id="create_post_btn" name="create_post_btn" class="btn btn-primary btn-block shadow">Create</button>
			</div>

		<?php echo form_close(); ?>	
	</div>
</div>
</section>

