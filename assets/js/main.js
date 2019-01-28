
  $(document).ready(function(e){

    // file upload style
    bsCustomFileInput.init();

    // date picker
    $(function() {
      $('.datetimepicker4').datetimepicker({
        pickTime: false
      });
    });

    // function for toggling card in animation
    function toggler_cards(btn, card, msg){
        $(btn).click(function(){           
          if ($(this).text() == msg) 
            $(this).text("Close"); 
            else 
            $(this).text(msg); 
          $(card).slideToggle();});
    }

    toggler_cards('#edit_card_toggle_btn', '#edit_profile_form', "Change Anything?"); 
    toggler_cards('#user_profile_advanced_btn', '#user_profile_advanced', 'Advanced');
    toggler_cards('.category_create_btn', '#create_category_form', 'Add Category');
    
    // change text on two buttons in create category
    $(".category_form_close_btn").click(function(event){
      event.preventDefault();

      if ($(".category_create_btn").text() == "Add Category") { 
      $(".category_create_btn").text("Close"); 
      } else { 
      $(".category_create_btn").text("Add Category"); 
    }; 

    $('#create_category_form').slideUp();
    });

  //  animation functions using anime js
  // add a delay to the animation
  $(this).delay(50).queue(function() {

      // show the index page texts with animations
      $('#title_text').show();
      $('#quote').show();
      $('#author').show();

    // Wrap every letter in a span
    $('.ml6 .letters').each(function(){
      $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
    });

    // animation of title logo
    anime.timeline()
      .add({
        targets: '.ml6 .letter',
        translateY: ["1.1em", 0],
        translateZ: 0,
        duration: 300,
        delay: function(el, i) {
          return 40 * i;
        }
    });

    // Wrap every letter in a span
    $('.ml3').each(function(){
      $(this).html($(this).text().replace(/([^\x00-\x80]|.|\w)/g, "<span class='letter2'>$&</span>"));
    });

    // animation of title tagline and quote
    anime.timeline()
      .add({
        targets: '.ml3 .letter2',
        opacity: [0,1],
        easing: "easeInOutQuad",
        duration: 70,
        delay: function(el, i) {
          return 50 * (i+1)
        }
      });

        // end delay
        $(this).dequeue();
    });
    
  });



  // ajax functions
      
  $(window).on('load', function(){
  
    // call ajax functions
    create_category();list_category();hit_counter();search_box();   

    // call functions only on profile page
    if (window.location.pathname == "/pencil/users/profile") 
      show_user_posts();show_all_users();show_all_categories();delete_user();delete_post();delete_category();block_and_unblock_user();   
    
    // call functions only on main page
    if (window.location.pathname == "/pencil/posts") 
      show_posts();get_posts_by_category();load_more_posts();get_posts_by_date();
    

    

  // category filetering using checkbox function
  function get_posts_by_category(){
    var postcounter = 4;
    var category_id = [];

    $('#category_filter_submit').click(function(){

      // prevent default behaviour of submit button
      event.preventDefault();
      postcounter = postcounter + 4;

      $("input[name='category_name']:checked").each(function(i){
              category_id[i] = $(this).val();
      });

      if(category_id.length == 0){
        show_posts();
      }
      



      var JSON_cat = JSON.stringify(category_id);

      // ajax to get posts based on selected categories
      $.ajax({
                  url:"http://localhost/pencil/categories/posts",
                  data: {category: JSON_cat, nextpostnumber: postcounter},
                  type:'POST',
                  dataType: 'json',
          success: function (data) {blog_card(data);category_id.length = 0;},error: function () {console.log("my bad");}});
                  
        });
  }



        // filter by date
        function get_posts_by_date(){
          var postcounter = 4;
          
  
  
                $('#date_filter_box').on('click', '#date_filter', function(){
  
                    // prevent default behaviour of submit button
                    event.preventDefault();
                    postcounter = postcounter + 4;
  
  
                    var dates = [];
  
                   dates[0] = $('#from_date').val();
                   dates[1] = $('#to_date').val();
                    
  
                    var JSON_date = JSON.stringify(dates);
  
                    // ajax to get posts based on selected categories
                    $.ajax({
                                url:"http://localhost/pencil/posts/cardbydate",
                                data: {dates: JSON_date, nextpostnumber: postcounter},
                                type:'POST',
                                dataType: 'json',
                                success: function (data) {blog_card(data);},error: function () {console.log("my bad");}});
                          });
  
              }

      
    

      // hit counter
      function hit_counter(){
        $(".blog-body").on("click", "#the_read_more_btn", function (event) {
        
          var post_id = $(this).attr('data');
          post_id = Number(post_id);
          $.ajax({
            url: "http://localhost/pencil/posts/hit_counter",
            type: 'post',
            dataType: 'text',
            data: {post_id: post_id},
            success: function (response) {
            }
          });
          
        });
      }



      // show posts
      function show_posts(){
        var postcounter = 4;
        $.ajax({
          type: 'post',
          url: "http://localhost/pencil/posts/card",
          dataType: 'json',
          data: {nextpostnumber: postcounter},
          success: function (data) {blog_card(data);},error: function () {console.log("my bad");}});
      }

      // show posts
      function load_more_posts(){       
        var postcounter = 4;
        $("#load_more").click(function(){
        postcounter = postcounter + 4;
        $.ajax({
          type: 'post',
          url: "http://localhost/pencil/posts/card",
          dataType: 'json',
          data: {nextpostnumber: postcounter},
          success: function (data) {
            blog_card(data);
            if(postcounter >= data['num_posts']){
              $("#load_more").hide();
            }
          },error: function () {console.log("my bad");}});
      });}


      function blog_card(data){        
        var html = "NO POSTS";
        if(data['posts'].length > 0){        
        html = "<div class='row'>";
        for(i=0; i<data['posts'].length; i++){
        html += '<div class="card-deck col-lg-6"><div class="card w-100 shadow m-2" >'+
                '<img src="http://localhost/pencil/assets/images/posts/'+data['posts'][i].pencil_db_posts_post_image+'"'+
                ' class="card-img-top img-fluid" style="height: 250px;width: 100%; align-self: center;">'+
                '<div class="card-body"><span class="text-muted" style="font-size: 12px;text-decoration: none;">';
        // show user details of the post author 
        for(j=0; j<data['users'].length; j++){
            if(data['posts'][i].pencil_db_posts_user_id == data['users'][j].pencil_db_users_id){
              html +='<img src="http://localhost/pencil/assets/images/profile/'+data['users'][j].pencil_db_users_image+'" class="rounded-circle img-fluid mr-2" style="height: 30px;width: 30px;">'+ data['users'][j].pencil_db_users_username;
        }}
        html +='<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>'+data['posts'][i].pencil_db_posts_created_date+'<span>&nbsp;&nbsp;</span>'+
               '|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>'+data['posts'][i].pencil_db_posts_views+'<span>&nbsp;&nbsp;</span>'+
                '|<span>&nbsp;&nbsp;</span>'+data['posts'][i].pencil_db_categories_name+'<span>&nbsp;&nbsp;</span></span><br><br>'+
                '<p class="card-title h5">'+data['posts'][i].pencil_db_posts_title+'</p></div>'+
                '<div class="card-footer"><a href="http://localhost/pencil/posts/'+data['posts'][i].pencil_db_posts_slug+'" data="'+data['posts'][i].pencil_db_posts_id+'"'+
                'class="btn btn-primary btn-block shadow" id="the_read_more_btn">Read More</a></div>'+
                '</div></div>';
        }html += "</div>";}$(".blog-body").html(html);
      }

      // list categories
      function list_category(){


        $.ajax({
          type: 'ajax',
          url: "http://localhost/pencil/categories/index",
          async: false,
          dataType: 'json',
          success: function(data){
            var html = "";
            if(data.length > 0){
              for(i=0; i<data.length; i++){
                html += '<option value='+data[i].pencil_db_categories_id+'>'+data[i].pencil_db_categories_name+'</option>';
              }
            }
            $("#list_categories").html(html);
          }
        });
      }


      //function show all product
      function show_user_posts(){

        $.ajax({
            type  : 'ajax',
            url   : 'http://localhost/pencil/users/posts',
            async : true,
            dataType : 'json',
            success : function(data){
              
              var html = "";
              if(data.length > 0){
                
                html = '<div class="card shadow col-md-12 col-lg-12"><p class="h5 mt-2 card-header text-center">Posts</p>'+
                           '<div class="card-body"><div class="card container"><table class="table"><thead><tr><th class="col" style="border: none;">Posts</th>'+
                           '<th class="col text-center" style="border: none;">Edit</th><th class="col text-center" style="border: none;">Delete</th>'+
                           '</tr></thead><tbody>';
                var i;
                for(i=0; i<data.length; i++){

                        html += '<tr>'+
                                '<td>'+data[i].pencil_db_posts_title+'</td>'+
                                '<td class="col"><a style="color: white" href="http://localhost/pencil/posts/edit/'+data[i].pencil_db_posts_slug+'" data='+data[i].pencil_db_posts_id+' class="btn btn-success shadow block_btn"><i class="fas fa-pencil-alt"></i></button></td>'+
                                ' <form action="">'+
                                ' <td class="col"><button type="submit" data='+data[i].pencil_db_posts_id+' class="btn btn-danger shadow post_delete"><i class="fas fa-trash-alt"></i></button></td>'+
                                '</form>'+'</tr>';
                    
            }
            html +='</tbody></table></div></div></div>';
          }    
          
          
          $('#show_user_posts').html(html);   


        }});
    }
    
    // delete post ajax
    function delete_post(){
      $('#show_user_posts').on('click', '.post_delete', function(event){

        event.preventDefault();
            var id = $(this).attr('data');
            $.ajax({
              type: 'POST',
              async: true,
              url: 'http://localhost/pencil/posts/delete',
              data:{id:id},
              dataType: 'text',
              success: function (response) {
                console.log('delete statement')
                  show_user_posts();
                },
                error: function () {
                  alert("ajax error");
                }
                
              });
        });

      }

      // delete category ajax
    function delete_category(){
      $('#show_user_category').on('click', '.profile_category_delete_btn', function(event){
        event.preventDefault();
            var id = $(this).attr('data');
            $.ajax({
              type: 'POST',
              async: true,
              url: 'http://localhost/pencil/categories/delete',
              data:{id:id},
              dataType: 'text',
              success: function (response) {
                  show_all_categories();
                },
                error: function () {
                  alert("ajax error");
                }
                
              });
        });

      }




      //function show all users
        function show_all_users(){
            $.ajax({
                type  : 'ajax',
                url   : 'http://localhost/pencil/users/profile_user_list',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = "";
                  if(data.length > 1){
                    html = '<div class="card shadow col-md-12 col-lg-12"><p class="h5 mt-2 card-header text-center">Manage Users</p>'+
                                '<div class="card-body"><div class="card container"><table class="table"><thead><tr><th class="col" style="border: none;">Users</th>'+
                                '<th class="col text-center" style="border: none;">Block</th><th class="col text-center" style="border: none;">Delete</th>'+
                                '</tr></thead><tbody>';
                    var i;
                    for(i=0; i<data.length; i++){

                      // only show non admins
                      if(data[i].pencil_db_users_is_admin == "no"){

                        // if the user is active show block button
                        if(data[i].pencil_db_users_is_active == "yes"){
                            html += '<tr>'+
                                    '<td>'+data[i].pencil_db_users_username+'</td>'+
                                    '<td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-danger shadow block_btn"><i class="fas fa-user-minus"></i></button></td>'+
                                    ' <form action="">'+
                                    ' <td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-danger shadow user_delete"><i class="fas fa-trash-alt"></i></button></td>'+
                                    '</form>'+
                                    '</tr>';
                        }else{
                            // if the user is not active show unblock button
                            html += '<tr>'+
                                    '<td>'+data[i].pencil_db_users_username+'</td>'+
                                    '<td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-success shadow unblock_btn"><i class="fas fa-user-minus"></i></button></td>'+
                                    ' <form action="">'+
                                    ' <td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-danger shadow user_delete"><i class="fas fa-trash-alt"></i></button></td>'+
                                    '</form>'+
                                    '</tr>';
                        }
                      }
                    }
                    html +='</tbody></table></div></div></div>';
                }
                $('#show_user_data').html(html);

              }
 
            });
        }


        // create category using ajax
        function create_category(){
          $('#category_create_form').on('click', '#create_category_btn', function(event){
              event.preventDefault();
              var cate_name =  $("#create_category_name").val(); 
              if(cate_name != ""){
                     
                    $.ajax({
                        type: 'post',
                        url: 'http://localhost/pencil/categories/create',
                        async: false,
                        dataType: 'text',
                        data: {
                          cate_name: cate_name
                        },
                        success : function(data){
                          list_category();
                          $("#create_category_name").val("");
                          $('.category_create_btn').click();
                        }
                    });
            }else{
              console.log("field empty");
            }
          });
        }


        //function show all product
        function show_all_categories(){
          $.ajax({
              type  : 'ajax',
              url   : 'http://localhost/pencil/users/profile_category_list',
              async : false,
              dataType : 'json',
              success : function(data){

                var html = "";
                if(data.length > 0){

                html = '<div class="container col-md-12 col-lg-12"><div class="card shadow"><p class="h5 mt-2 text-center card-header">Categories</p>'+
                             '<ul class="list-unstyled container "><hr>';
                var i;
                for(i=0; i<data.length; i++){
                      
                      html +='<li class="list-item p-2 m-1"><span>'+data[i].pencil_db_categories_name+'<span><button type="submit" data="'+data[i].pencil_db_categories_id+'" class="btn btn-danger profile_category_delete_btn shadow float-right"><i class="fas fa-trash-alt fa-xs"></i></button></span></span>';
                                            
                    }

                    html +='</li></ul></div></div>';

                  }
                  $('#show_user_category').html(html);

                } 
              
            });

      }


        // delete user ajax
        function delete_user(){
        $('#show_user_data').on('click', '.user_delete', function(event){
              event.preventDefault();
              var id = $(this).attr('data');
              $.ajax({
                type: 'POST',
                async: true,
                url: 'http://localhost/pencil/users/delete',
                data:{id:id},
                dataType: 'text',
                success: function (response) {
                  
                    show_all_users();
                 
                  },
                  error: function () {
                    alert("ajax error");
                  }
                  
                });
               

          });
          

        }
      

        // block/ unblock user by ajax
        function block_and_unblock_user(){

          // block user ajax
          $('#show_user_data').on('click', '.block_btn', function(event){
            event.preventDefault();
                var id = $(this).attr('data');
                $.ajax({
                  type: 'ajax',
                  method: 'POST',
                  async: true,
                  url: 'http://localhost/pencil/users/block',
                  data:{id:id},
                  dataType: 'text',
                  success: function (response) {
                    
                    
                    console.log("okkkk");
                    
                    
                    },
                    error: function () {
                      alert("ajax error");
                    }
                    
                  });
                  show_all_users();
            });

            // unblock user ajax
            $('#show_user_data').on('click', '.unblock_btn', function(event){
              event.preventDefault();
                  var id = $(this).attr('data');
                  $.ajax({
                    type: 'ajax',
                    method: 'POST',
                    async: true,
                    url: 'http://localhost/pencil/users/unblock',
                    data:{id:id},
                    dataType: 'text',
                    success: function (response) {
                      
                      
                      console.log("okkkk");
                      
                      
                      },
                      error: function () {
                        alert("ajax error");
                      }
                      
                    });
                    show_all_users();
              });
  
        }




        // search box
        function search_box(){
          $(".nav_search_btn").on('click', function (event) {

            event.preventDefault();

            

            var search_term = $("#nav_search_box").val().trim();


            
            $.ajax({

              type: 'post',
              url: "http://localhost/pencil/posts/search",
              dataType: 'json',
              data: {search_term: search_term},
              success: function (data) {

                // if(data){
              
                //   location.href="http://localhost/pencil/posts";
    
                // }

                // var data = $.parseJSON(response);
                var html = "<p>NO POSTS FOUND</p>";
                if(data['posts'].length > 0){


                  html = "<div class='row'>";
                  for(i=0; i<data['posts'].length; i++){
                    html += '<div class="card-deck col-lg-6"><div class="card w-100 shadow m-2" ><img src="http://localhost/pencil/assets/images/posts/'+data['posts'][i].pencil_db_posts_post_image+'" class="card-img-top img-fluid" style="height: 250px;width: 100%; align-self: center;">'+
                            '<div class="card-body"><span class="text-muted" style="font-size: 12px;text-decoration: none;">'+
                            '<span>&nbsp;&nbsp;</span>Abhay<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Jan 2019<span>&nbsp;&nbsp;</span>|<span>&nbsp;&nbsp;</span><i class="far fa-eye"></i><span>&nbsp;&nbsp;</span>500<span>&nbsp;&nbsp;</span>'+
                            '|<span>&nbsp;&nbsp;</span>'+data['posts'][i].pencil_db_categories_name+'<span>&nbsp;&nbsp;</span></span><br><br>'+
                            '<p class="card-title h5">'+data['posts'][i].pencil_db_posts_title+'</p></div>'+
                            '<div class="card-footer"><a href="http://localhost/pencil/posts/'+data['posts'][i].pencil_db_posts_slug+'" class="btn btn-primary btn-block shadow" id="the_read_more_btn">Read More</a></div>'+
                            '</div></div>';
                  }
                  html += "</div>";
                  
                }                

                $(".blog-body").html(html);
                console.log("working!!!!");
              },error: function () {
                console.log("my bad from search box");
              }

            });
            
          });
        }
        

      
  });





        