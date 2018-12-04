<br>
<div class="card z-depth-5"><br>
<section class="center">
			<div class="container">
				<div class="row">
					<div class="col s12 m12 l12">
						<div class="card-panel z-depth-5 hoverable">
            <img id="profile_pic" class="circle responsive-img" src="<?php echo site_url(); ?>assets/images/profile/<?php echo $this->session->userdata('user_image');?>">
            
            <h4><?php echo ucfirst($this->session->userdata('user_name')); ?></h4>
              <p class="chip"><?php echo $this->session->userdata('user_username'); ?></p>
              <p><?php echo $this->session->userdata('user_email'); ?></p>
              <p>Posts : &nbsp&nbsp<?php echo $posts; ?></p>
            </div>
					</div>
				</div>
			</div>
    </section>
    <br>
    <!-- edit button -->
		<a class="btn-floating btn-large waves-effect waves-light halfway-fab right deep-purple z-depth-5" href="<?php echo base_url(); ?>users/edit/<?php echo $this->session->userdata('user_id'); ?>"><i class="fas fa-pencil-alt"></i></a>
</div>
<br>