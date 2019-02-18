<section class="container mb-5 mt-5" style="overflow: hidden;">
  <div class="card shadow-lg">
	<?php echo form_open_multipart('posts/update'); ?>

	<!-- this hidden field is to get posts id for updating -->
	<input type="hidden" name="post_id" value="<?php echo $post['pencil_db_posts_id']; ?>">

    <div class="row pr-5 pl-5">
      <!-- first column -->
      <div class="col-lg-5">
      	<div id="create_post_form_title">
        	<h3 class="text-center animated bounceInDown mb-5 mt-5">Update!</h3>
    	</div>
        <!-- title -->
         <div class="form-group mb-4">
            <div class="input-group">
              <input type="text" name="post_title" value="<?php echo $post['pencil_db_posts_title']; ?>" class="form-control" placeholder="Title" required autofocus>
            </div>
         </div>

        <!-- image -->
        <div class="form-group mb-4">
          <div class="input-group">
            <div class="custom-file">
			  <input type="hidden" name="userfile1" size="20" value="<?php echo $post['pencil_db_posts_post_image']; ?>">
              <input type="file" class="custom-file-input" name="userfile" size="20" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">Upload Image</label>
            </div>
          </div>
       </div>

       <!-- category -->
       <div class="form-group mb-4">
         <div class="input-group">
             <select name="post_category" class="custom-select">
             	  <option value="<?php echo $post['pencil_db_categories_id']; ?>">Choose new Category</option>
                <?php foreach($categories as $category): ?>   
                <option value="<?php echo $category['pencil_db_categories_id']; ?>"><?php echo $category['pencil_db_categories_name']; ?></option>
                <?php endforeach; ?>    	
             </select>
         </div>
       </div>

      

    </div>
    <!-- second column -->
    <div class="col-lg-7 mt-5">
      <div class="form-group d-flex justify-content-center">
        <div class="input-group animated flipInX">
          <textarea name="post_body" id="ckeditor_textarea" class="form-control" placeholder="Body" required><?php echo $post['pencil_db_posts_body']; ?></textarea>
        </div>
      </div>
    </div>
    </div>
	

	 <div class="card-footer d-flex justify-content-center">
           <button type="submit" id="create_post_btn"  class="btn btn-primary shadow-lg" name="create_post_btn" style="width: 200px">Update</button>
       </div>
	<?php echo form_close(); ?>	
	<?php echo validation_errors('<p id="error_p" class="alert text-center alert-danger mr-5 ml-5">', '</p>'); ?>
    </div>
  </div><br><br>
</section>
