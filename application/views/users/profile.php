
<section id="profile_section" style="overflow: hidden">
<br>
<!-- main row -->
<div class="row" style="margin: auto">
<!-- sidebar -->
<div class="col-md-12 col-lg-3">
<div class="row">
<div class="col-md-12 col-lg-12">


<!-- profile card -->
<div class="container col-md-12 col-lg-12"><br>

        <div class="card shadow">
            <div class="container text-center"><br>

            <img src="<?php echo site_url(); ?>assets/images/profile/<?php echo $this->session->userdata('user_image');?>" id="post_single_img" class="img-fluid rounded-circle d-flex justify-content-center shadow"
            style="height: 100px;width: 100px;"><br>

            <ul class="list-unstyled">
                <li class="h6"><?php echo $this->session->userdata('user_username'); ?></li>
                <li><p class="text-wrap" style="font-size: 16px;margin-top: 1em"><?php echo $this->session->userdata('user_bio');?></p></li>
            </ul>

            </div>
            <div class="card-footer d-flex justify-content-center" style="border: none;background-color: #fff;margin-bottom: 1em">
                <button id="edit_card_toggle_btn" class="btn shadow btn-block btn-primary">Change Anything?</button>
            </div>
        </div>

</div><br>
<!-- profile card ends -->

<!-- users categories card -->
<div id="show_user_category">


</div>
<!-- users categories card ends -->

<!-- advanced -->
<div  id="user_profile_advanced" class="container col-md-12 col-lg-12"  style="display: none;"><br>
<div class="card shadow d-flex justify-content-center p-3">          
        <p class="h5 text-center p-1">Advanced</p><hr>
        <button class="btn btn-block mt-2 mb-2 btn-info shadow">Deactivate Account</button>
        <button class="btn btn-block mt-2 mb-2 btn-danger shadow">Delete Account</button>
</div>
</div>

<div class="container col-md-12 col-lg-12"><br>
    <button id="user_profile_advanced_btn" class="btn btn-block btn-secondary shadow">Advanced</button>
</div><br>
<!-- advanced ends -->

</div>
</div>
</div>
<!-- sidebar -->

<!-- mainbar -->
<div class="col-md-12 col-lg-9">

<!-- row starts -->
<div class="row mb-2" id="edit_profile_form" style="margin: auto;display: none;">

<!-- edit card -->
<div class="col-md-12 col-lg-12" style="margin-top: 1em">
    <!-- form -->
    <div class="card shadow text-center container col-md-12 col-lg-12">

    <h5 class="card-header mt-2">Edit</h5>
        <div class="container card-body" style="width: 80%;">

            <?php echo form_open_multipart('users/update'); ?>	
                <input type="hidden" name="userfile1" size="20" value="<?php echo $this->session->userdata('user_image'); ?>">
                <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">			
                <div class="row">
                    <div class="form-group col-lg-6">
                        <input type="email" class="form-control" name="user_email" value="<?php echo $this->session->userdata('user_email'); ?>" placeholder="email" >
                    </div>
                <div class="form-group col-lg-6">                  
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="userfile" size="20">
                        <div class="container text-left">
                            <label class="custom-file-label" for="customFile" style="color: grey;">Profile Pic</label>
                        </div>
                    </div>
                    </div>
                <div class="form-group col-lg-12">                                  
                    <textarea rows="2" class="form-control" name="user_bio" id="signup_bio" placeholder="Bio" ><?php echo $this->session->userdata('user_bio'); ?></textarea>
                </div>
                <div class="card-footer col-lg-12">
                    <button type="submit" name="edit_post_btn" class="btn btn-block btn-primary shadow">Update</button>
                </div>
                </div>			
            <?php echo form_close(); ?>
                
            <?php echo validation_errors('<p id="error_p" class="alert alert-danger">', '</p>'); ?>

			<p><a href="<?php echo base_url(); ?>users/login" class="form-text badge badge-pill badge-light" style="color: #222; font-size: 15px;text-decoration: none;">Change Password?</a></p>

        </div>

    </div>
    <!-- form ends -->
</div>
<!-- edit card ends -->
</div>
<!-- row ends-->



<!-- row starts -->
<div class="row" style="margin: auto;">

<!-- progress card -->
<div class="col-md-12 col-lg-12" style="margin-top: 1em">
    <!-- counters -->
    <div class="card shadow text-center container col-md-12 col-lg-12">
        <p class="h5 mt-2 card-header">Overview</p>
        <!-- counters row -->
        <div class="row card-body">
        <!-- post counter -->
        <div class="card container text-center col-md-12 col-lg-4" style="margin: auto;border: none;border-right: 1px solid #ddd">            
                    <i class="fas fa-pencil-alt" style="color: #1976d2"></i>
                <div class="card-body">
                    <span class="post_counter h5" style="font-size: 2em">0</span><br>
                    <span class="font-weight-bold text-muted">POSTS</span>
                    <script>
                        var a = '<?php echo $posts; ?>';
                        $(".post_counter").animateNumber({number: a});
                    </script>
                </div>
        </div>

        <!-- comment counter -->
        <div class="card container text-center col-md-12 col-lg-4" style="margin: auto;border: none;border-right: 1px solid #ddd">
                    <i class="far fa-comments" style="color: #f4511e"></i>
                <div class="card-body">
                    <span class="comment_counter h5" style="font-size: 2em">0</span><br>
                    <span class="font-weight-bold text-muted">COMMENTS</span>
                    <script>
                        var a = '<?php echo $posts; ?>';
                        $(".comment_counter").animateNumber({number: a});
                    </script>
                </div>
        </div>

        <!-- view counter -->
        <div class="card container text-center col-md-12 col-lg-4" style="margin: auto;border: none;">
                    <i class="far fa-eye" style="color: #009688"></i>
            <div class="card-body">
                <span class="view_counter h5" style="font-size: 2em">0</span><br>
                <span class="font-weight-bold text-muted">VIEWS</span>
                <script>
                        var a = '<?php echo $posts; ?>';
                        $(".view_counter").animateNumber({number: a});
                </script>
            </div>
        </div>

        </div>
        <!-- counter row ends -->
    </div><br>
    <!-- counter card ends -->
</div><br>
<!-- progress card ends -->
</div>
<!-- row ends-->

<!-- user posts card -->
<div  id="show_user_posts"class="row container" style="margin: auto;">

</div><br>
<!-- user posts card ends -->



<!-- admin powers :-P -->
<?php if($this->session->userdata('is_admin') == 'yes') : ?>


<!-- user tabel row starts-->
<div id="show_user_data" class="row container" style="margin: auto;">

</div><br>
<!-- user tabel row starts-->

<?php endif;?>


</div>
<!-- mainbar ends -->
</div>
<!-- main row ends -->
</section>

