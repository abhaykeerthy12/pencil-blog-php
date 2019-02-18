<section id="all_blog">

<div class="row" style="margin: auto;">
<!-- the main column starts (posts list column) -->
<div class="container col-sm-12 col-md-12 col-lg-12"><br>
		
		<!-- we are including the posts as cards from another page (to use ajax efficiently) -->
		<div><h1><?=$title?></h1><hr></div>  
		<div class="row d-flex justify-content-center">
			  <?php foreach ($posts as $post): ?>

			<div class="card-deck col-lg-4">
			  <div class="card m-3 w-100 p-0 shadow-lg blog-body animated bounceInUp" >
			   <a class="the_read_more_btn" data="<?php echo $post['pencil_db_posts_id']; ?>" href="<?php echo site_url('/posts/' . $post['pencil_db_posts_slug']) ?>" style="color: black;">

			    <!-- card img -->
			    <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image'];?>" class="w-100 card-img img-fluid" style="height: 200px;">

			    <!-- card header -->
			     <div class="card-header p-2">
			        <p>
			          <span class="badge badge-light"><i class="fas fa-tags mr-1"></i><?php echo $post['pencil_db_categories_name'];?></span> 

			            <!-- display comment count -->
			            <?php $comment_counter = 0; ?>
			            <?php foreach ($comments as $comment): ?>
			            <?php if($comment['pencil_db_comments_post_id'] == $post['pencil_db_posts_id']) : ?>
			              <?php $comment_counter++; ?>
			            <?php endif; ?>
			            <?php endforeach; ?>
			            <span class="float-right"><span class="badge badge-light mr-1 ">
			              <i class="fas fa-comments mr-1"></i><?php echo $comment_counter; ?>
			            </span>
			            <?php $comment_counter = 0; ?>

			        <span class="badge badge-light"><i class="fas fa-eye mr-1"></i><?php echo $post['pencil_db_posts_views'];?></span></span>
			        </p>
			      </div>

			    <!-- card body -->
			    <div class="card-body p-0 pl-3 pr-3">
			      <p class="card-title"><?php echo $post['pencil_db_posts_title'];?></p>
			    </div>

			    <!-- card footer -->
			    <div class="card-footer p-2">
			        <p>
			        <?php foreach ($users as $user): ?>
			        <?php if($post['pencil_db_posts_user_id'] == $user['pencil_db_users_id']) : ?>
			          <span><img src="<?php echo site_url(); ?>assets/images/profile/<?php echo $user['pencil_db_users_image'];?>" class="rounded-circle img-fluid mr-1" style="height: 30px;width: 30px;"></span>
			          <span class="badge badge-light"><?php echo $user['pencil_db_users_username'] ?></span> 
			          <span class="badge float-right badge-light">
			            <i class="fas fa-clock mr-1"></i>
			            <?php echo date('d-M-y', strtotime(str_replace('-','/', $post['pencil_db_posts_created_date'])));?> 
			         </span>
			        <?php endif; ?>
			        <?php endforeach; ?>
			        </p>
			    </div>

			   </a>
			  </div>
			</div><br>
			  <?php endforeach; ?>

			</div>
</div>
</div>
<br>
</section>