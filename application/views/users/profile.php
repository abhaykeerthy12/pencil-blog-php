<br>
<section class="center">
			<div class="container">
				<div class="row card z-depth-5 hoverable">
					<div class="col s12 m12 l12">
						<div class="card card-panel z-depth-5 hoverable">
            <img style="width: 175px;height: 175px;" class="circle responsive-img" src="<?php echo site_url(); ?>assets/images/profile/<?php echo $this->session->userdata('user_image');?>">
            
            <h4><?php echo ucfirst($this->session->userdata('user_name')); ?></h4>
              <p class="chip"><?php echo $this->session->userdata('user_username'); ?></p>
              <p><?php echo $this->session->userdata('user_email'); ?></p>
              <p><?php echo $this->session->userdata('user_bio');?></p>
              <p>Posts : &nbsp&nbsp<?php echo $posts; ?></p>
              <a href="<?php echo base_url(); ?>users/posts" class="btn deep-purple">View your latest creations</a>
              <!-- edit button -->
              <a class="btn-floating btn-large waves-effect waves-light halfway-fab right red accent-3 z-depth-5" href="<?php echo base_url(); ?>users/edit/<?php echo $this->session->userdata('user_id'); ?>"><i class="fas fa-pencil-alt"></i></a>
            </div><br>
            
            <!-- admin powers :-P -->
            <?php if($this->session->userdata('is_admin') == 'yes') : ?>
            <?php if(sizeof($users) > 1) : ?>
            <br>
            <div class="col s12 m12 l12">
                        
                <table class="white hoverable centered z-depth-5">
              <thead>
                  <tr>
                      <td colspan="2"><h5 class="center-align">Manage Users</h5></td>
                  </tr>
              </thead>
              <tbody>
              <!-- loop through the categories array and get each category  -->
              <?php foreach ($users as $user): ?>
              <?php if($user['pencil_db_users_is_admin'] == 'no') : ?>
              <tr>    
                  
                <!-- column with shows category names -->
                  <td><h6><?php echo ucfirst($user['pencil_db_users_name']); ?></h6></td>

                <!-- if a creater of any category is logged in, show another column with delete button to delete the category -->
                <form action="<?php echo base_url(); ?>users/delete/<?php echo $user['pencil_db_users_id'] ?>" method="POST">
                      <td><button type="submit" class="btn red accent-3 waves-effect waves-light"><i class="fas fa-trash"></i></button></td>
                  </form>

              </tr>
              <?php endif; ?>
              <?php endforeach;?>
              <!-- loop ends -->
              </tbody>
              </table>
              <br>
            </div>
            
            <?php endif;?>
            <?php endif;?>

					</div>
          
				</div>
        
			</div>
      
</section>


