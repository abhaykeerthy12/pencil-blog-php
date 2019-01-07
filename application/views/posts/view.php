<!-- section starts -->
<section id="post_single"><br><br>

<!-- row starts -->
<div class="row" style="margin: auto;">

		<!-- the content column starts -->
		<div class="container col-sm-12 col-md-12 col-lg-9"><br>
			
			<!-- container div inside the content column start-->
			<div class="container">
				<img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" id="post_single_img" class="img-fluid d-flex justify-content-center shadow"><br><br>

				<div class="container">
				<h1 class="text-wrap"><?php echo ucfirst($post['pencil_db_posts_title']); ?></h1><br>
				
				<a href="" class="text-muted" style="font-size: 13px;text-decoration: none;">
					<img src="<?php echo site_url(); ?>assets/images/profile/<?php echo $user['pencil_db_users_image'];?>" class="rounded-circle img-fluid" style="height: 50px;width: 50px;">
					<span>&nbsp&nbsp</span><?php echo $user['pencil_db_users_username']; ?><span>&nbsp&nbsp</span>|
					<span>&nbsp&nbsp</span><i class="far fa-clock"></i><span>&nbsp&nbsp</span>Jan 2019<span>&nbsp&nbsp</span>|<span>&nbsp&nbsp</span><i class="far fa-eye"></i><span>&nbsp&nbsp</span>500<span>&nbsp&nbsp</span>
					
				</a><br><br>

				<div id="post_body" class="text-wrap">
					<p><?php echo $post['pencil_db_posts_body'] ?></p>
				</div><br>

					

				<!-- list comments -->
				<div>
					<!-- check if any comments are present -->
					<?php if ($comments): ?>
					<h2>6 Comments</h2><br>
					<ul class="list-unstyled">
						<!-- is yes, then loop through them and display them -->
						<?php foreach ($comments as $comment): ?>
						<li>
							<div class="card container">	
								<div class="clearfix"><br>
								  <img src="../assets/images/icons/placeholder-male.png" class="rounded-circle img-fluid" style="height: 50px;width: 50px;">
								  <span>&nbsp;&nbsp;</span>
								  <span class="h4"><?php echo ucfirst($comment['pencil_db_comments_name']); ?></span>
								  <span>&nbsp;&nbsp;</span>
								  <span class="text-muted">Jan 2019</span>
								 
								  <?php if($this->session->userdata('user_id') == $post['pencil_db_posts_user_id'] || $this->session->userdata('is_admin') == 'yes') : ?>
											
											<form action="<?php echo base_url(); ?>comments/delete/<?php echo $comment['pencil_db_comments_id'] ?>" method="POST">
												<!-- passing slug hidden for further processing -->
												<input type="hidden" name="comment_post_slug" value="<?php echo $post['pencil_db_posts_slug']; ?>">
									  			<button type="submit" class="btn btn-danger float-right shadow" style="border-radius: 50px;margin-right: 1em"><i class="fas fa-trash"></i></button>
										    </form>

								  <?php endif; ?>

								<br></div><br>
								<div class="container">
									<p class="text-wrap container" style="padding-left: 3em"><?php echo $comment['pencil_db_comments_body']; ?></p>
								</div>
							<br></div><br>
						</li>
						<?php endforeach;?>
					</ul>
					<?php else: ?>
						<!-- if no, display "no comments" message -->
						<blockquote><hr>
							<p class="lead" >No comments for this post</p>
						</blockquote><hr>
					<?php endif;?>
				</div><br>
				

					
					<!-- Add comment -->
		
					<div class="card shadow container" style="padding: 2em">

						<h2>Leave a comment</h2><br>
						<!-- show any errors while filling form -->
						<?php echo validation_errors(); ?>
						<!-- form starts -->
							<?php if($post['pencil_db_posts_user_id'] == $this->session->userdata('user_id') || $this->session->userdata('logged_in')): ?>

								<?php echo form_open('comments/create/' . $post['pencil_db_posts_id']); ?>
							
								<div class="form-group">
									<input type="hidden" id="comment_name" name="comment_name" value="<?php echo $this->session->userdata('user_username') ?>">
			  						<input type="hidden" id="comment_email" name="comment_email" value="<?php echo $this->session->userdata('user_email') ?>">

									<textarea rows="2" class="form-control" name="comment_body" placeholder="Comment" required></textarea><br>	

									<!-- passing slug hidden for further processing -->
									<input type="hidden" name="comment_post_slug" value="<?php echo $post['pencil_db_posts_slug']; ?>">

									<div class="text-center">
											<button type="submit" class="btn btn-primary shadow">Comment</button>
									</div>
								</div>
										  
								<?php echo form_close(); ?>
								<!-- form over -->

							<?php else: ?>

								<?php echo form_open('comments/create/' . $post['pencil_db_posts_id']); ?>
							
								<div class="form-group">
									<input type="text" id="comment_name" class="form-control" placeholder="Name" name="comment_name"><br>
			  						<input type="email" class="form-control" placeholder="Email" id="comment_email" name="comment_email"><br>


									<textarea rows="2" class="form-control" name="comment_body" placeholder="Comment" required></textarea><br>	

									<!-- passing slug hidden for further processing -->
									<input type="hidden" name="comment_post_slug" value="<?php echo $post['pencil_db_posts_slug']; ?>">

									<div class="text-center">
											<button type="submit" class="btn btn-primary shadow">Comment</button>
									</div>
								</div>
										  
								<?php echo form_close(); ?>
								<!-- form over -->
						<?php endif; ?>
		
					</div>	
					<!-- Add comment close  -->


				</div>
			</div>
			<!-- container div inside the content column close -->
	</div>
	<!-- the content column close -->
	
	<!-- the small sidebar starts -->
	<div class="container col-sm-12 col-md-12 col-lg-3"><br>

			<!-- Author -->
			<div class="card">
				<div class="container text-center"><br>
					
			    <p class="h3">Author</p>

				<img src="<?php echo site_url(); ?>assets/images/profile/<?php echo $user['pencil_db_users_image'];?>" id="post_single_img" class="img-fluid rounded-circle d-flex justify-content-center shadow"
				style="height: 100px;width: 100px;"><br>

				<ul class="list-unstyled">
					<li class="h6"><?php echo $user['pencil_db_users_username']; ?></li>
					<li><p class="text-wrap" style="font-size: 16px;margin-top: 1em"><?php echo $user['pencil_db_users_bio'];?></p></li>
					<li><a href="<?php echo site_url('users/authorposts/' . $user['pencil_db_users_id']); ?>" class="btn btn-primary btn-block shadow">More posts by author</a><br></li>
				</ul>


				</div>
			</div><br><hr><br><br>



			<!-- Recommended Posts -->
			<p class="h4 text-center">Recommended Posts</p><hr>

			<div class="card">
				  <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" class="card-img-top">
				  <div class="card-body">
				    <h5 class="card-title">The Blog Title</h5>			
				  </div>
			</div><br>

			<div class="card">
				  <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" class="card-img-top">
				  <div class="card-body">
				    <h5 class="card-title">The Blog Title</h5>			
				  </div>
			</div><br>

			<div class="card">
				  <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" class="card-img-top">
				  <div class="card-body">
				    <h5 class="card-title">The Blog Title</h5>			
				  </div>
			</div><br>

			<div class="card">
				  <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" class="card-img-top">
				  <div class="card-body">
				    <h5 class="card-title">The Blog Title</h5>			
				  </div>
			</div><br>		
	</div>
	<!-- the small sidebar ends -->

</div><br><br>
<!-- row close -->

</section>
<!-- section close -->
