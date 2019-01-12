<section id="profile_section" style="overflow: hidden">
<br>
<div class="row container" style="margin: auto">
    <div class="card shadow col-md-12 col-lg-6 container"> 
        <div class="d-flex justify-content-center">      
            <img style="width: 220px;height: 220px;margin: 20px" class="card-img-top shadow-lg img-fluid rounded-circle" src="<?php echo site_url(); ?>assets/images/profile/<?php echo $this->session->userdata('user_image');?>">
        </div>
            <div class="card-body container text-center">
                <div class="card-text">
                        <p><?php echo $this->session->userdata('user_username'); ?></p>
                        <p><?php echo $this->session->userdata('user_email'); ?></p>
                        <p><?php echo $this->session->userdata('user_bio');?></p>
                </div>            
            </div>
            <div class="card-footer" style="border: none;background-color: #fff">
                <a href="<?php echo base_url(); ?>users/posts" class="btn btn-primary btn-block shadow">View your latest creations</a>
            </div><br>
    </div><br>
    <div class="col-md-12 col-lg-6"></div>
</div>
<br>
</section>


