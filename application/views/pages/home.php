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
    <div class="card w-100 shadow" >
      <a href="<?php echo base_url(); ?>" style="text-decoration: none;color: black;">
    
        <!-- card image -->
        <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image'];?>" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">
        
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
         <span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|
          <span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Jan 2019<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>
          |<span>&nbsp;&nbsp;</span><?php echo $post['pencil_db_categories_name'];?><span>&nbsp;&nbsp;</span>
        </span><br><br>
        
        <!-- card title -->
        <span class="card-title h5"><?php echo $post['pencil_db_posts_title'];?></span>
        
        

        </div>
        <!-- card body ends -->

    </a></div><br>
    <!-- card ends -->
  <?php endforeach; ?>

</div>  
</section><br><hr><br>
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

    <!-- card starts -->
    <div class="card w-100 shadow" >
    
        <!-- card image -->
        <img src="https://via.placeholder.com/150" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">
        
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
         <span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|
          <span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Jan 2019<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>
          |<span>&nbsp;&nbsp;</span>Animals<span>&nbsp;&nbsp;</span>
        </span><br><br>
        
        <!-- card title -->
        <a href="" style="text-decoration: none;color: black;"><span class="card-title h5">Some quick example text to build</span></a>
        
        

        </div>
        <!-- card body ends -->
        
        <!-- card footer -->
        <div class="card-footer" style="border: none;background-color: white">
          <a href="post.php" class="btn btn-primary btn-block shadow">Read more</a>
        </div>
        <!-- card footer ends -->

    </div><br>
    <!-- card ends -->

    <!-- card starts -->
    <div class="card w-100 shadow" >
    
        <!-- card image -->
        <img src="https://via.placeholder.com/150" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">
        
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
         <span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|
          <span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Jan 2019<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>
          |<span>&nbsp;&nbsp;</span>Animals<span>&nbsp;&nbsp;</span>
        </span><br><br>
        
        <!-- card title -->
        <a href="" style="text-decoration: none;color: black;"><span class="card-title h5">Some quick example text to build</span></a>
        
        

        </div>
        <!-- card body ends -->
        
        <!-- card footer -->
        <div class="card-footer" style="border: none;background-color: white">
          <a href="post.php" class="btn btn-primary btn-block shadow">Read more</a>
        </div>
        <!-- card footer ends -->

    </div><br>
    <!-- card ends -->

    <!-- card starts -->
    <div class="card w-100 shadow" >
    
        <!-- card image -->
        <img src="https://via.placeholder.com/150" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">
        
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
         <span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|
          <span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Jan 2019<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>
          |<span>&nbsp;&nbsp;</span>Animals<span>&nbsp;&nbsp;</span>
        </span><br><br>
        
        <!-- card title -->
        <a href="" style="text-decoration: none;color: black;"><span class="card-title h5">Some quick example text to build Some quick example text to build Some quick example text to buildSome quick example text</span></a>
        
        

        </div>
        <!-- card body ends -->
        
        <!-- card footer -->
        <div class="card-footer" style="border: none;background-color: white">
          <a href="post.php" class="btn btn-primary btn-block shadow">Read more</a>
        </div>
        <!-- card footer ends -->

    </div><br>
    <!-- card ends -->



</div>  
</section><br><br>
<!-- popular posts ends -->
