<!-- page starts -->
<!-- looping through the posts array which contains post data from database -->

<h4 class="center-align"><?= $title ?></h4>

<?php foreach ($posts as $post) : ?>
<br>

<div class="row card z-depth-5 hoverable">
	<div class="col s12 m6 l4">
		<!-- post image -->
		<img class="responsive-img card" 
		src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['pencil_db_posts_post_image']; ?>">
	</div>

	<!-- other contents -->
	<div class="card-content">
		<div class="card-title">
			<!-- title -->
			<span><h4 style="font-weight: bold"><?php echo ucfirst($post['pencil_db_posts_title']); ?></h4></span>

			<!-- created date and category name -->
			<small class="chip z-depth-1">Posted on: &nbsp<?php echo $post['pencil_db_posts_created_date']; ?> in <?php echo $post['pencil_db_categories_name'] ?></small>
		</div>

		<!-- post body (words are limited to 75, just for the asthetics) -->
		<p class="flow-text"><?php echo word_limiter($post['pencil_db_posts_body'], 35); ?></p>

		<!-- read more button (its a floating button) -->
		<a class="btn btn-floating btn-large halfway-fab waves-effect waves-light deep-purple z-depth-5" 
			href="<?php echo site_url('/posts/'.$post['pencil_db_posts_slug']) ?>"><i class="fas fa-angle-double-right"></i></a>
	</div>
</div>

<br>
<?php endforeach; ?>
<!-- loop ends -->
<!-- pagination -->
<div class="index_pagination center">
	<?php echo $this->pagination->create_links(); ?>
</div>

<!-- page ends -->