<section id="profile_section" style="overflow: hidden">
<br>
<div class="row container" style="margin: auto">

    <!-- profile card -->
    <div class="card shadow container col-md-12 col-lg-12"><br>
          
         <!-- profile pic -->
         <div class="d-flex justify-content-center">
                <img style="width: 350px;height: 350px; margin: 1em" class="img-fluid rounded-circle d-flex justify-content-center shadow-lg" src="<?php echo site_url(); ?>assets/images/profile/<?php echo $this->session->userdata('user_image');?>">
         </div>
         
         <!-- profile details -->
         <div class="card-body text-center">
                <p><b><?php echo $this->session->userdata('user_username'); ?></b></p>
                <p><?php echo $this->session->userdata('user_email'); ?></p>
                <p><?php echo $this->session->userdata('user_bio');?></p>
         </div>
         <div class="card-footer d-flex justify-content-center" style="border: none;background-color: #fff;margin-bottom: 1em">
            <a href="" class="btn btn-primary shadow">Change anything?</a>
         </div>
    </div>
</div><br>

<!-- progress card -->
<div class="row container" style="margin: auto;">
    <div class="card shadow text-center container col-md-12 col-lg-12"><br>
        <p class="h1">Overview</p><br>
        <div class="row">

            <!-- post counter -->
            <div class="card container text-center col-md-12 col-lg-4" style="margin: auto;border: none;border-right: 1px solid #ddd">
                <div class="card-title">                
                    <i class="fas fa-pencil-alt fa-2x" style="color: #1976d2"></i>
                </div>
                <div class="card-body">
                    <span class="post_counter h5" style="font-size: 5em">0</span><br>
                    <p class="h6 text-muted">POSTS</p>
                    <script>
                         var a = <?php echo $posts; ?>;
                         $(".post_counter").animateNumber({number: a});
                    </script>
                </div>
            </div>

            <!-- comment counter -->
            <div class="card container text-center col-md-12 col-lg-4" style="margin: auto;border: none;border-right: 1px solid #ddd">
                <div class="card-title">
                    <i class="far fa-comments fa-2x" style="color: #f4511e"></i>
                </div>
                <div class="card-body">
                    <span class="comment_counter h5" style="font-size: 5em">0</span><br>
                    <p class="h6 text-muted">COMMENTS</p>
                    <script>
                         var a = <?php echo $posts; ?>;
                         $(".comment_counter").animateNumber({number: a});
                    </script>
                </div>
            </div>

            <!-- view counter -->
            <div class="card container text-center col-md-12 col-lg-4" style="margin: auto;border: none;">
                <div class="card-title">
                     <i class="far fa-eye fa-2x" style="color: #009688"></i>
                </div>
                <div class="card-body">
                    <span class="view_counter h5" style="font-size: 5em">0</span><br>
                    <p class="h6 text-muted">VIEWS</p>
                    <script>
                         var a = <?php echo $posts; ?>;
                         $(".view_counter").animateNumber({number: a});
                    </script>
                </div>
            </div>
           
        </div>

        <div class="card-footer d-flex justify-content-center" style="border: none;background-color: #fff;margin-bottom: 1em">
                <a href="" class="btn shadow btn-primary">View Your Creations</a>
        </div><br>

    </div>
</div><br>
<!-- progress card ends -->

<!-- admin powers :-P -->
<?php if($this->session->userdata('is_admin') == 'yes') : ?>


<!-- user tabel row starts-->
<div class="row container" style="margin: auto;">
<!-- card starts -->
<div class="card shadow col-md-12 col-lg-12">

    <br>
    <p class="h1 text-center">Manage Users</p><br>
    <!-- table starts -->
    <div class="card container">
    <table class="table">
    
        <!-- headings -->
        <thead>
        <tr>
            <th class="col" style="border: none;">Users</th>
            <th class="col text-center" style="border: none;">Block</th>
            <th class="col text-center" style="border: none;">Delete</th>
        </tr>
        </thead>

    <!-- content/users table body starts-->
    <tbody id="show_user_data">
        
    </tbody>
    <!-- table body ends -->
    </table>
    </div>
    <!-- table ends -->

<br>  
</div>
<!-- card ends -->
</div>
<!-- user tabel row starts-->

<?php endif;?>

</section><br>
