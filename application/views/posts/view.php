<br>
<div id="view_post_page_card" class="row card">

	<div class="col s12">
		<!-- title -->
		<h2 class="center-align"><?php echo ucfirst($post['pencil_db_posts_title']); ?></h2>
	</div>
	<div class="cols12">
		<!-- image -->
		<img id="view_page_img" class="hoverable responsive-img z-depth-5" 
			 src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>"><br><br>
	</div>

	<div class="card-content">
		<!-- date -->
		<small class="chip z-depth-1">Posted on: &nbsp<?php echo $post['pencil_db_posts_created_date']; ?></small>
		<!-- body -->
		<p><?php echo $post['pencil_db_posts_body'] ?></p>
	</div><br>
	<hr>


	<!-- comments section-->
	<h5>Comments</h5>
	<!-- check if any comments are present -->
	<?php if($comments) : ?>
		<!-- is yes, then loop through them and display them -->
		<?php foreach ($comments as $comment) : ?>


			<ul class="collection">
			    <li class="collection-item avatar">
			     <blockquote>
			      <img src="../assets/images/icons/placeholder-male.png" alt="" class="circle">
			      <span class="title"><strong><?php echo ucfirst($comment['pencil_db_comments_name']);?> :</strong></span>
			      <br>
			      <p><?php echo $comment['pencil_db_comments_body']; ?></p>
			      </blockquote>
			    </li>
			 </ul>

		<?php endforeach; ?>

	<?php else : ?>

		<!-- if no, display "no comments" message -->
		<blockquote>
			<p>No comments for this post</p>	
		</blockquote>

	<?php endif ; ?>
	<!-- comment section over -->


	<!-- add comments section -->
	<hr>
    <ul class="collapsible popout">
    	<li>
	 	<div class="collapsible-header"><h5>Add Comment</h5></div>
	 	<div class="collapsible-body">
	 		<!-- show any errors while filling form -->
			<?php echo validation_errors(); ?>
			<!-- form starts -->
			<?php echo form_open('comments/create/'.$post['pencil_db_posts_id']); ?>
				<!-- name field -->
			    <div class="col s12">
					<div class="row">
						    <div class="input-field col s12">
						      <input type="text" id="comment_name" name="comment_name" autofocus required>
						      <label for="comment_name">Name</label>
							</div>
					</div>
				</div>
				<!-- email field -->
				<div class="col s12">
					<div class="row">
						    <div class="input-field col s12">
						      <input type="email" id="comment_email" name="comment_email" required>
						      <label for="comment_email">Email</label>
							</div>
					</div>
				</div>
				<!-- comment body field -->
				<div class="col s12">
					<div class="row">
						    <div class="input-field col s12">
						      <textarea type="text" class="materialize-textarea" id="comment_body" name="comment_body" required></textarea>
						      <label for="comment_body">Body</label> 
							</div>
					</div>
				</div>
				<!-- passing slug hidden for further processing -->
				<input type="hidden" name="comment_post_slug" value="<?php echo $post['pencil_db_posts_slug']; ?>">
				<!-- submit button -->
				<button type="submit" class="btn waves-effect waves-light deep-purple">Comment</button>

			<?php echo form_close(); ?>
			<!-- form over -->

		</div>
		</li>
	</ul>
	<!-- add comment section over -->

	<!-- edit and delete buttons -->
	<?php if($this->session->userdata('user_id') == $post['pencil_db_posts_user_id'] || $this->session->userdata('is_admin') == 'yes'): ?>
		<hr>
		<!-- edit button -->
		<a class="btn-floating btn-large waves-effect waves-light halfway-fab left green z-depth-5" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['pencil_db_posts_slug']; ?>"><i class="fas fa-pencil-alt"></i></a><br><br>
		<!-- delete button -->
	    <?php echo form_open('posts/delete/'.$post['pencil_db_posts_id']); ?>
	
	        <button type="submit" class="btn-floating btn-large waves-effect waves-light z-depth-5 halfway-fab red modal-trigger"><i class="fas fa-trash"></i></button>
	    </form>
	<?php endif; ?>

</div>
<br>