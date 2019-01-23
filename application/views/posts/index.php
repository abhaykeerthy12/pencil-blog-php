
<!-- this is the page where all posts are listed, so its called "blog page" / "index page" -->

<!-- the main section starts -->
<section id="all_blog">

<!-- this page has 2 columns(1 side bar for filters and other to list the posts) -->
<!-- row starts -->
<div class="row" style="margin: auto;">

	<!-- the sidebar column  starts-->
	<div class="container col-sm-12 col-md-12 col-lg-2"><br><br>
		<p class="h4">Refine by</p><hr>

		<!-- category filter section -->
		<div class=" card shadow col-sm-12 col-md-12 col-lg-12">

			<!-- the category filter column -->
			<p class="h5" style="border-bottom: 1px solid #eee;padding: 2px;padding-bottom: 5px">
				Categories
			</p>
			
			<!-- loop through categories in database and list its names -->
			<ul class="list-unstyled container " id="category_filter">

					<!-- fetch category names from database -->
					<?php foreach ($categories as $category): ?>
					<li class="list-item">
						
						<label class="custom-control custom-checkbox">
						<input type="checkbox" name="category_name" class="custom-control-input" value="<?php echo $category['pencil_db_categories_id']; ?>">
						<span class="custom-control-label" for="category_name">
							<?php echo $category['pencil_db_categories_name']; ?>
						</span>
						</label>

					</li>
					<?php endforeach;?>

			</ul>

			
				<div class="card-footer d-flex justify-content-center" style="background-color: #fff;border: none;">
					<button type="submit" class="btn btn-primary btn-block shadow-lg" id="category_filter_submit">Apply</button>
				</div>

		</div><br>
		

		<!-- the date filter column -->
		<div class="container shadow card col-sm-12 col-md-12 col-lg-12" id="date_filter_box">
			<p class="h5" style="border-bottom: 1px solid #eee;padding: 2px;padding-bottom: 5px">
				Date
			</p>
			<form>

				<!-- from date -->
				<div class="datetimepicker4" class="form-group d-flex justify-content-center">
					
					<p class="mt-3 mb-3">From :
					
					<button class="add-on btn btn-info shadow float-right"><i class="fas fa-calendar-alt"></i></button>

					</p>

					<input data-format="yyyy-MM-dd" id="from_date" placeholder="yyyy-mm-dd" class="form-control" type="text" required>

		
				</div>


				<!-- To date -->
				<div class="datetimepicker4" class="form-group d-flex justify-content-center">
					
					<p class="mt-3 mb-3">To :
					
					<button class="add-on btn btn-info shadow float-right"><i class="fas fa-calendar-alt"></i></button>

					</p>

					<input data-format="yyyy-MM-dd" id="to_date" placeholder="yyyy-mm-dd" class="form-control" type="text" required>

		
				</div>


				<!-- submit btn -->
				<div class="card-footer d-flex justify-content-center" style="background-color: #fff;border: none;">
					<button type="submit" id="date_filter" class="btn btn-primary btn-block shadow-lg">Apply</button>
				</div>
			</form>
		</div>
	</div>
	<!-- the sidebar column ends -->


	<!-- the main column starts (posts list column) -->
	<div class="container col-sm-12 col-md-12 col-lg-10"><br>
		
		<!-- we are including the posts as cards from another page (to use ajax efficiently) -->
		<div><h1><?=$title?></h1><hr></div>  

		<div class="blog-body">
		
		</div><br>

		<div class="container">
				<button class="btn btn-primary btn-block" id="load_more" value="">Load more..</button><br>
		</div>
		
	</div>
	<!-- the main column ends -->
	
</div>
<!-- row ends -->
</section>
<!-- the main section ends -->



  


