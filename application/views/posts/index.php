<section id="all_blog">
<div class="row" style="margin: auto;">
	<div class="container col-sm-12 col-md-12 col-lg-2" style="background-color: blue;"><br>
		<div class="col-sm-12 col-md-12 col-lg-12">
			
		</div>
	</div>
	<div class="container col-sm-12 col-md-12 col-lg-10"><br>
		<div><h1><?=$title?></h1><hr></div>  
			
<div class="col-sm-12 col-md-12 col-lg-12">

<?php foreach ($posts as $post): ?>

        <div class="card w-100 p-3 shadow" style="width: 18rem;">
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
	 <br>
		<!-- pagination -->
		<nav aria-label="Page navigation">
			<div class="d-flex justify-content-center">
			<?php echo $this->pagination->create_links(); ?>
			</div>
		</nav>
		<br>
	</div>
	
</div>
</section>








