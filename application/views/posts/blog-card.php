
<div class="row">

<?php foreach ($posts as $post): ?>

<div class="card-deck col-lg-6">

    <!-- card starts -->
    <div class="card w-100 shadow m-2" >
    
        <!-- card image -->
        <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>" class="card-img-top img-fluid" style="height: 200px;width: 100%; align-self: center;">
                
        <!-- card body -->
        <div class="card-body">
        
        <!-- category time and hits -->
        <span class="text-muted" style="font-size: 12px;text-decoration: none;">
         <span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|
          <span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span><?php echo date('M-Y', strtotime(str_replace('-','/', $post['pencil_db_posts_created_date']))); ?><span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>
          <?php foreach ($categories as $category): ?>
        
          <?php if($post['pencil_db_posts_category_id'] == $category['pencil_db_categories_id']) : ?>

          |<span>&nbsp;&nbsp;</span><?php echo $category['pencil_db_categories_name']; ?><span>&nbsp;&nbsp;</span>

          <?php endif; ?>


          <?php endforeach; ?>
        </span><br><br>
        
        <!-- card title -->
        <a href="<?php echo site_url('/posts/' . $post['pencil_db_posts_slug']) ?>" style="text-decoration: none;color: black;"><span class="card-title h5"><?php echo ucfirst($post['pencil_db_posts_title']); ?></span></a>
        
        

        </div>
        <!-- card body ends -->
        
        <!-- card footer -->
        <div class="card-footer" style="border: none;background-color: white">
          <a href="<?php echo site_url('/posts/' . $post['pencil_db_posts_slug']) ?>" class="btn btn-primary btn-block shadow">Read more</a>
        </div>
        <!-- card footer ends -->

    </div>
    <!-- card ends -->
    
    </div>

<?php endforeach;?>

</div>