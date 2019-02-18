<br><br>

<!-- page starts -->
<section id="self_distruct_card" class="mb-5 pb-5">
<div class="container p-5 mb-5">
	<div class="card shadow-lg p-5 animated flipInX">
		<!-- title -->
		<h3 class="text-center"><?=$title;?></h3><br>
		<?php echo form_open('users/self_distruct'); ?>

		<div class="form-group pr-5 pl-5">
			<div class="container pr-5 pl-5">
				<!-- password field -->
		        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" autofocus required>
			</div>
	    </div>
	  	<div class="card-footer d-flex justify-content-center">
			<button type="submit" class="btn btn-danger shadow-lg rounded-circle p-1"><i class="fas fa-3x m-1 fa-exclamation-circle"></i></button>
			<?php echo form_close(); ?>
		</div>
	</div>

</div>
</section>