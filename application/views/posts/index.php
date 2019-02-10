
<!-- this is the page where all posts are listed, so its called "blog page" / "index page" -->

<!-- the main section starts -->
<section id="all_blog" style="overflow: hidden;">

<!-- this page has 2 columns(1 side bar for filters and other to list the posts) -->
<!-- row starts -->
<div class="row" style="margin: auto;">

	<!-- the main column starts (posts list column) -->
	<div class="container col-sm-12 col-md-12 col-lg-12"><br>
		
		<!-- we are including the posts as cards from another page (to use ajax efficiently) -->
		<div><p><span class="h1"><?=$title?></span><span><button id="filter_btn" class="btn shadow-lg btn-primary float-right"><i class="fas fa-2x shadow-lg fa-sliders-h"></i></button></span></p><hr></div>  

		<div class="row p-4" id="filter_box" style="display: none;">

		<p class="h4 col-lg-12 mb-3 pb-3 text-center" style="border-bottom: 1px solid #eee;">Refine by</p>
		
		<div class="card shadow-lg col-lg-12" style="overflow: hidden;margin: auto;">
			<p class="p-1" style="border-bottom: 1px solid #eee;">
			<span class="h5">Categories</span>
			<span><button type="submit" class="btn float-right btn-primary mb-1 shadow-lg" id="category_filter_submit">
				<i class="fas shadow-lg h4 mb-0 fa-check"></i>
			</button></span>
			</p>
			<!-- loop through categories in database and list its names -->
			<ul class="list-unstyled container row" id="category_filter">

					<!-- fetch category names from database -->
					<?php foreach ($categories as $category): ?>
					<li class="list-item col-lg-2 ">
						
						<label class="custom-control custom-checkbox">
						<input type="checkbox" name="category_name" class="custom-control-input" value="<?php echo $category['pencil_db_categories_id']; ?>">
						<span class="custom-control-label" for="category_name">
							<?php echo $category['pencil_db_categories_name']; ?>
						</span>
						</label>

					</li>
					<?php endforeach;?>

			</ul>
			
		</div>

		<div class="card mt-4 mb-4 shadow-lg col-lg-12" style="overflow: hidden;margin: auto;" id="date_filter_box">

			<p class="p-1" style="border-bottom: 1px solid #eee;">
			<span class="h5">Date</span>
			<span><button type="submit" class="btn float-right btn-primary mb-1 shadow-lg" id="date_filter">
				<i class="fas shadow-lg h4 mb-0 fa-check"></i>
			</button></span>
			
			<div class="row">
			<!-- from date -->
			<div class="datetimepicker4 col-lg-6 form-group " >
				
				<p class="mt-3 mb-3">From :
				
				<button class="add-on btn btn-info shadow float-right"><i class="fas fa-calendar-alt"></i></button>

				</p>

				<input data-format="yyyy-MM-dd" id="from_date" placeholder="yyyy-mm-dd" class="form-control" type="text" required>

	
			</div>

			<!-- To date -->
			<div class="datetimepicker4 col-lg-6 form-group ">
				
				<p class="mt-3 mb-3">To :
				
				<button class="add-on btn btn-info shadow float-right"><i class="fas fa-calendar-alt"></i></button>

				</p>

				<input data-format="yyyy-MM-dd" id="to_date" placeholder="yyyy-mm-dd" class="form-control" type="text" required>

	
			</div>
			</div>
			
		</div>

	
		</div>

		<div class="blog-body">
		
		</div><br>	
		
	</div>
	<!-- the main column ends -->
	
</div>


<div id="load_more_container">
<div class="container d-flex justify-content-center mb-3" id="load_more" style="border-top: 1px solid #eee">
	<button class="btn btn-primary shadow-lg mt-3 btn-lg" value=""><i class="shadow-lg fas fa-2x m-1 fa-angle-double-down"></i></button><br>
</div>
</div>
<!-- row ends -->
</section>
<!-- the main section ends -->



  


