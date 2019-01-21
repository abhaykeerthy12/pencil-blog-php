<div class="col-sm-12 col-md-12 col-lg-12">

<?php foreach ($posts as $post): ?>

        <div class="card w-100 p-3 shadow" style="width: 18rem;height:">
        <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
        <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" class="card-img-top" style="height: 200px;width: 100%; align-self: center;">
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">

        <div class="card-body">
           
            <a href="<?php echo site_url('/posts/' . $post['pencil_db_posts_slug']) ?>" style="text-decoration: none;color: black"><span class="card-title h5" style="max-height: 3em;height: 3em;"><?php echo ucfirst($post['pencil_db_posts_title']); ?></span></a>
            <br>

            <a href="<?php echo site_url('/posts/' . $post['pencil_db_posts_slug']) ?>" style="text-decoration: none;color: black"><p class="card-text" style="margin-top: 1em;"><?php echo word_limiter($post['pencil_db_posts_body'], 20); ?></p></a>
            <span class="text-muted" style="font-size: 12px;text-decoration: none;">
					<img src="<?php echo base_url(); ?>/assets/images/images/laptop.svg" class="rounded-circle img-fluid" style="height: 50px;width: 50px;">
					<span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|
					<span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span><?php echo date('M-Y', strtotime(str_replace('-','/', $post['pencil_db_posts_created_date']))); ?><span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>
					|<span>&nbsp;&nbsp;</span><?php echo $post['pencil_db_categories_name']; ?><span>&nbsp;&nbsp;</span>
				</span>
        </div>
        </div>
        </div>
        </div>

<?php endforeach;?>




</div>

<div class="col-lg-6">

<?php foreach ($posts as $post): ?>

<div class="card-deck">

    <!-- card starts -->
    <div class="card w-100 shadow" >
    
        <!-- card image -->
        <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">
        
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
         <span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|
          <span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Jan 2019<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>
          |<span>&nbsp;&nbsp;</span>Animals<span>&nbsp;&nbsp;</span>
        </span><br><br>
        
        <!-- card title -->
        <a href="" style="text-decoration: none;color: black;"><span class="card-title h5"><?php echo ucfirst($post['pencil_db_posts_title']); ?></span></a>
        
        

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

<?php endforeach;?>

</div>