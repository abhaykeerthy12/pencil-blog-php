<!-- main bg image and text -->
<section id="showcase" class="shadow-lg">

<div id="showcase_text" class="text-center">  
  <h1 style="font-family: 'Courgette'; " class="display-1 animated bounceInDown">Pencil</h1>
  <p class="animated bounceInLeft" style="font-family: 'Courgette';">Let the ideas flow...</p>
  <button class="btn btn-primary animated bounceInUp shadow-lg">Lets go!</button>
</div>

</section>
<!-- main image ends -->

<!-- latest posts start -->
<section class="latest_posts" style="margin-left: 5%;margin-right: 5%"><br>
<div><h1>Latest Posts</h1><hr></div> 
<div class="card-deck">
  <?php foreach ($l_posts as $post): ?>
  <div class="card w-100 p-0 shadow-lg blog-body" >
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
            <i class="fas fa-clock mr-1"></i><?php echo $post['pencil_db_posts_created_date'];?>
          </span>
        <?php endif; ?>
        <?php endforeach; ?>
        </p>
    </div>

   </a>
  </div>
  <?php endforeach; ?>
</div><br>
<div class="container d-flex justify-content-center mb-3" style="border-top: 1px solid #eee">
  <a class="btn btn-primary shadow-lg mt-3 btn-lg" href="<?php echo base_url(); ?>posts"><i class="shadow-lg fas fa-2x m-1  fa-angle-double-right"></i></a>
</div>
</section><hr>
<!-- latest posts ends -->


<!-- become member starts -->
<section class="become_member text-center container">
  <h2>Become a member!</h2>
  <div class="row container">
    <div class="col-sm-12 col-md-6 col-lg-6">
      <img src="<?php echo base_url(); ?>/assets/images/images/laptop.svg" class="img-fluid" style="height: 300px; width: 300px;">
   </div>
    <div class="col-sm-12 col-md-6 col-lg-6 text-center container"><br><br><br>
    <p>We, The Pencil Team had an aim of developing a blog application with a different approach. Our aim was fueled with passion and hard-work, hope you enjoy the experience</p><br>
    <a class="btn btn-primary shadow" style="color: white" href="signup.php">Join</a>
    </div>
  </div><br>
</section><hr><br>
<!-- become member ends -->

<!-- popular posts start -->
<section class="popular_posts" style="margin-left: 5%;margin-right: 5%">

<div><h1>Popular Posts</h1><hr></div> 

<div class="card-deck">
  <?php foreach ($p_posts as $post): ?>
  <div class="card w-100 p-0 shadow-lg blog-body" >
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
            <i class="fas fa-clock mr-1"></i><?php echo $post['pencil_db_posts_created_date'];?>
          </span>
        <?php endif; ?>
        <?php endforeach; ?>
        </p>
    </div>

   </a>
  </div>
  <?php endforeach; ?>
</div>
 
</section><br><br>
<!-- popular posts ends -->
