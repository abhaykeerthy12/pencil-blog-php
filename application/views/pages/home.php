<!-- the banner -->
<section id="title_box"><br>
  <div id="title_text">
    <h1 class="ml6">
    <span class="text-wrapper">
      <span class="letters">Pencil</span>
    </span>
  </h1>
    <h5 class="ml3">Let the ideas flow...</h5>
  </div> 
</section>
<!-- the banner ends -->


<!-- giant quote -->

<section class="giant-quote jumbotron text-center container">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">



      <p id="quote" class="ml3">"The more that you read, the more things you will know. <br>The more that you learn, the more places you’ll go."</p><br>
      <p id="author" class="ml3">― Dr. Seuss</p>

      
    </div><br><br><br>
  </div>
</section><hr>

<!-- the giant quote ends -->


<!-- latest posts start -->
<section class="latest_posts" style="margin-left: 5%;margin-right: 5%"><br>

<div><h1>Latest Posts</h1><hr></div> 


<div class="card-deck">

  <?php foreach ($l_posts as $post): ?>

    <!-- card starts -->
    <div class="card w-100 p-0 shadow-lg blog-body" >
      <a class="the_read_more_btn" data="<?php echo $post['pencil_db_posts_id']; ?>" href="<?php echo site_url('/posts/' . $post['pencil_db_posts_slug']) ?>" style="text-decoration: none;color: black;">
    
        <!-- card image -->
        <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image'];?>" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">

        <?php foreach ($users as $user): ?>

        <?php if($post['pencil_db_posts_user_id'] == $user['pencil_db_users_id']) : ?>
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
          <img src="<?php echo site_url(); ?>assets/images/profile/<?php echo $user['pencil_db_users_image'];?>" class="rounded-circle img-fluid mr-1" style="height: 30px;width: 30px;">

          <span class="mr-1"><?php echo $user['pencil_db_users_username'] ?></span>|

          <i class="far fa-clock"></i><span class="ml-1 mr-1"><?php echo $post['pencil_db_posts_created_date'];?></span>|

          <span class="mr-1 ml-1"><i class="far fa-eye"></i></span><span class="mr-1"><?php echo $post['pencil_db_posts_views'];?></span>

          |<span class="ml-1"><?php echo $post['pencil_db_categories_name'];?></span>
        </span><br><br>
        
        <!-- card title -->
        <span class="card-title h5"><?php echo $post['pencil_db_posts_title'];?></span>
        
        <?php endif; ?>
        <?php endforeach; ?>

        </div>
        <!-- card body ends -->

    </a></div><br>
    <!-- card ends -->
  <?php endforeach; ?>

  

</div> <br>

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

    <!-- card starts -->
    <div class="card w-100 p-0 shadow-lg blog-body" >
      <a class="the_read_more_btn" data="<?php echo $post['pencil_db_posts_id']; ?>" href="<?php echo site_url('/posts/' . $post['pencil_db_posts_slug']) ?>" style="text-decoration: none;color: black;">
    
        <!-- card image -->
        <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image'];?>" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">

        <?php foreach ($users as $user): ?>

        <?php if($post['pencil_db_posts_user_id'] == $user['pencil_db_users_id']) : ?>
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
          <img src="<?php echo site_url(); ?>assets/images/profile/<?php echo $user['pencil_db_users_image'];?>" class="rounded-circle img-fluid mr-1" style="height: 30px;width: 30px;">

          <span class="mr-1"><?php echo $user['pencil_db_users_username'] ?></span>|

          <i class="far fa-clock"></i><span class="ml-1 mr-1"><?php echo $post['pencil_db_posts_created_date'];?></span>|

          <span class="mr-1 ml-1"><i class="far fa-eye"></i></span><span class="mr-1"><?php echo $post['pencil_db_posts_views'];?></span>

          |<span class="ml-1"><?php echo $post['pencil_db_categories_name'];?></span>
        </span><br><br>
        
        <!-- card title -->
        <span class="card-title h5"><?php echo $post['pencil_db_posts_title'];?></span>
        
        <?php endif; ?>
        <?php endforeach; ?>

        </div>
        <!-- card body ends -->

    </a></div><br>
    <!-- card ends -->
  <?php endforeach; ?>



</div>  
</section><br><br>
<!-- popular posts ends -->
