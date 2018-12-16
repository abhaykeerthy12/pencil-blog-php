<br>
<section class="center">
			<div class="container">
				<div class="row card z-depth-5 hoverable">
					<div class="col s12 m12 l12">
						<div class="card card-panel z-depth-5 hoverable">
            <img style="width: 175px;height: 175px;" class="circle responsive-img hoverable" src="<?php echo site_url(); ?>assets/images/profile/<?php echo $this->session->userdata('user_image');?>">
            
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
                      <th colspan="3"><h5 class="center-align">Manage Users</h5></th>
                  </tr>
                  <tr style="border-bottom: 1px solid #bdbdbd;">
                    <th><h6 class="center-align">Users</h6></th>
                    <th><h6 class="center-align">Block</h6></th>
                    <th><h6 class="center-align">Delete</h6></th>
                  </tr>
              </thead>
              <tbody>
              <!-- loop through the users array and get each user  -->
              <?php foreach ($users as $user): ?>
              <!-- only show non-admin users -->
              <?php if($user['pencil_db_users_is_admin'] == 'no') : ?>
              <tr class="hoverable">    
                  
                <!-- column with shows user names -->
                  <td><h6><?php echo ucfirst($user['pencil_db_users_name']); ?></h6></td>

                <!-- block / unblock user btn -->
              <?php if($user['pencil_db_users_is_active'] == 'yes') : ?>
                <form action="<?php echo base_url(); ?>users/block/<?php echo $user['pencil_db_users_id'] ?>" method="POST">
                      <td><button type="submit" class="btn red accent-3 hoverable waves-effect waves-light"><i class="fas fa-user-minus"></i></button></td>
                </form>
              <?php else : ?>
                <form action="<?php echo base_url(); ?>users/unblock/<?php echo $user['pencil_db_users_id'] ?>" method="POST">
                      <td><button type="submit" class="btn waves-effect hoverable waves-light"><i class="fas fa-user-plus"></i></button></td>
                </form>
              <?php endif; ?>
                <form action="<?php echo base_url(); ?>users/delete/<?php echo $user['pencil_db_users_id'] ?>" method="POST">
                        <td><button type="submit" class="btn red accent-3 hoverable waves-effect waves-light"><i class="fas fa-trash-alt"></i></button></td>
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


