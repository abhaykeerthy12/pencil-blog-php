
  $(document).ready(function(e){

    // file upload style
    bsCustomFileInput.init();

    // date picker
    $(function() {
      $('.datetimepicker4').datetimepicker({
        pickTime: false
      });
    });

    // searchbox close
    $("#search_result_box_container").on('click', '#search_box_close', function(e){
      $("#search_result_box").slideUp(100);
      $("#nav_search_box").val('');
    });

    // toastr
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-center",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

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
    
     function toggler_cards_category(btn, card, msg){
        $(btn).click(function(){           
          if ($(this).text() == msg){ 
            $(this).text("Close");     
          }else {
            $(this).text(msg); 
          }
          $(card).toggle();});
    }

    toggler_cards_category('.category_create_btn', '#create_category_form', 'Add');
    toggler_cards_category('.category_form_close_btn', '#create_category_form', 'Add');


    
  });



  // ajax functions
      
  $(window).on('load', function(){
  
    // call ajax functions
    create_category();list_category();hit_counter();search_box();create_comment();delete_comment();show_comments();search_box_animation();   

    // call functions only on profile page
    if (window.location.pathname == "/pencil/users/profile") 
      show_user_posts();show_all_users();show_all_categories();delete_user();delete_post();delete_category();block_user();unblock_user();   
    
    // call functions only on main page
    if (window.location.pathname == "/pencil/posts") 
      show_posts();get_posts_by_category();load_more_posts();get_posts_by_date();


    function search_box_animation(){

        $('#filter_btn').on('click', function(event){
          event.preventDefault();
          $("#filter_box").slideToggle(100);

          show_posts();

          var status = $(this).html();

          if(status === '<i class="fas fa-2x shadow-lg fa-sliders-h"></i>')
          {
               $(this).html('<i class="fas fa-2x shadow-lg fa-times"></i>');
               $(this).addClass('btn-danger filter_btn_close');
               $(this).removeClass('btn-primary');
          }
          else
          {
               $(this).html('<i class="fas fa-2x shadow-lg fa-sliders-h"></i>');
               $(this).addClass('btn-primary');
               $(this).removeClass('btn-danger filter_btn_close');
               
          }

        });

  }


  function show_comments(){

    post_id = $("#comment_post_id").attr("value");
    post_user_id = $("#comment_post_user_id").attr("value");

    $.ajax({
      url: "http://localhost/pencil/comments/view",
      type: "POST",
      dataType: "JSON",
      data: {post_id: post_id},
      success: function(data){

        if(data['user'].length > 0){ 
           var user_is_admin = data['user'][0]['pencil_db_users_is_admin'];
           var user_id_db = data['user'][0]['pencil_db_users_id'];
        }

    

        // if no, display "no comments" message            
        var html = "<blockquote><hr> <p class='lead' >No comments for this post</p></blockquote><hr>";


        if(data['comments'].length > 0){        
        html = "<div>";
        if(data['comments'].length == 1)
          html +='<h2>'+data["comments"].length+' Comment</h2><br>';
        else
          html +='<h2>'+data["comments"].length+' Comments</h2><br>';

          for(i=0; i<data['comments'].length; i++){

            html += '<ul class="list-unstyled"><li><div class="card container"><div class="clearfix"><br>'+
                    '<img src="../assets/images/icons/placeholder-male.png" class="rounded-circle img-fluid" style="height: 50px;width: 50px;"><span>&nbsp;&nbsp;</span>'+
                    '<span class="h4">'+data['comments'][i].pencil_db_comments_name+'</span><span>&nbsp;&nbsp;</span><span class="text-muted">'+data['comments'][i].pencil_db_comments_created_date+'</span>';

             if(data['user'].length > 0){ 
                if(user_id_db == post_user_id || user_is_admin == "yes"){
                  html += '<button class="comment_delete_btn btn btn-danger float-right shadow" data="'+data['comments'][i].pencil_db_comments_id+'" style="border-radius: 50px;margin-right: 1em"><i class="fas fa-trash"></i></button>';
                }
             }


            html += '<br></div><br><div class="container"><p class="text-wrap container" style="padding-left: 3em">'+data['comments'][i].pencil_db_comments_body+'</p></div><br></div><br></li></ul>'


          }

        }

        html +=  "</div>";
        $("#list_comment_box").html(html);


      },
      error: function(){
        console.log('ajax error from show comments');
      }
    });
  }


    
  function create_comment(){
    $('.comment_submit').on('click', function(event){
      event.preventDefault();

      var user_logged_in = $('#user_logged_in').attr('value');
      var comment_post_id = $('#comment_post_id').attr('value');
      var comment_post_slug = $('#comment_post_slug').attr('value');
      var comment_body = $('#comment_body').val();

      if(user_logged_in){

          var comment_name = $('#comment_name').attr('value');
          var comment_email = $('#comment_email').attr('value');

      }else{

          var comment_name = $('#comment_name').val();
          var comment_email = $('#comment_email').val();

      }

      if((comment_body != "" && comment_email != "") && (comment_name != "")) {
        
        $.ajax({
          url: "http://localhost/pencil/comments/create",
          dataType: 'JSON',
          type: 'POST',
          data: {
            comment_post_id: comment_post_id,
            comment_post_slug: comment_post_slug,
            comment_name: comment_name,
            comment_email: comment_email,
            comment_body: comment_body
          },
          success: function(response){ 

            if(response){
              
              show_comments();
              toastr.info("Comment Created!");
              $('#comment_body').val('');

              if(!user_logged_in){
              $('#comment_name').val('');
              $('#comment_email').val('');
             }

            }
            
           },
          error: function(e){console.log("ajax error from create comment");}
        });

      }else{
        toastr.warning("Fields are empty!");
      }

    
    });
  }

  function delete_comment(){

    $('#list_comment_box').on('click', '.comment_delete_btn', function(event){

      event.preventDefault();

      var comment_id = $(this).attr("data");
      $.ajax({
        url: "http://localhost/pencil/comments/delete",
        type: "POST",
        dataType: "JSON",
        data: {comment_id: comment_id},
        success: function(response){
          if(response){
            show_comments();
            toastr.error("Comment Deleted!");
          }
        },
        error: function(){
          console.log("ajax error from delete comment");
        }
      });

        
    });

  }
  // category filetering using checkbox function
  function get_posts_by_category(){
    var postcounter = 10;
    var category_id = [];

    $('#category_filter_submit').click(function(){

      // prevent default behaviour of submit button
      event.preventDefault();
      postcounter = postcounter + 10;

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
          var postcounter = 10;
          

  
                $('#date_filter_box').on('click', '#date_filter', function(){
  
                    // prevent default behaviour of submit button
                    event.preventDefault();
                    postcounter = postcounter + 10;
  
  
                    var dates = [];
  
                   dates[0] = $('#from_date').val();
                   dates[1] = $('#to_date').val();

                   if(dates[0] == "" && dates[1] == "")
                      dates.length = 0;
                    
                    if(dates.length > 0){
                    var JSON_date = JSON.stringify(dates);
                    // ajax to get posts based on selected categories
                    $.ajax({
                                url:"http://localhost/pencil/posts/cardbydate",
                                data: {dates: JSON_date, nextpostnumber: postcounter},
                                type:'POST',
                                dataType: 'json',
                                success: function (data) {blog_card(data);dates.length = 0;},error: function () {console.log("my bad");}
                            });
                   }else
                      show_posts();

                  });
  
              }

      
    

      // hit counter
      function hit_counter(){
        $(".blog-body").on("click", ".the_read_more_btn", function (event) {
        
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
        var postcounter = 10;
        $.ajax({
          type: 'post',
          url: "http://localhost/pencil/posts/card",
          dataType: 'json',
          data: {nextpostnumber: postcounter},
          success: function (data) 
          {
            blog_card(data);
            if(postcounter >= data['num_posts']){
              $("#load_more_container").hide();
            }
          },error: function () {console.log("my bad");}});
      }

      // show posts
      function load_more_posts(){       
        var postcounter = 10;
        $("#load_more").on('click', '.btn', function(){
        postcounter = postcounter + 10;
        $.ajax({
          type: 'post',
          url: "http://localhost/pencil/posts/card",
          dataType: 'json',
          data: {nextpostnumber: postcounter},
          success: function (data) {
            blog_card(data);
            if(postcounter >= data['num_posts']){
              $("#load_more_container").hide();
              toastr.info("NO more Posts!");
            }
          },error: function () {console.log("my bad");}});
      });}


      function blog_card(data){        
        var html = "NO POSTS";
        var comment_count = 0;
        if(data['posts'].length > 0){        
        html = '<section class="row d-flex justify-content-center">';
        for(i=0; i<data['posts'].length; i++){
        html += '<div class="card-deck col-lg-4"><div class="card shadow-lg faster animated zoomIn p-0 m-3"><a href="http://localhost/pencil/posts/'+data['posts'][i].pencil_db_posts_slug+'" data="'+data['posts'][i].pencil_db_posts_id+'"'+
                ' class="the_read_more_btn" style="color: #000">'+
                '<img src="http://localhost/pencil/assets/images/posts/'+data['posts'][i].pencil_db_posts_post_image+'" class="w-100 card-img img-fluid" style="height: 200px;">'+
                '<div class="card-header p-2"><p><span class="badge badge-light"><i class="fas fa-tags mr-1"></i>'+data['posts'][i].pencil_db_categories_name+'</span>';       
        if(data['comments'].length == false)
          data['comments'].length = 0;          
        for(k=0; k<data['comments'].length; k++){
          if(data['comments'][k].pencil_db_comments_post_id === data['posts'][i].pencil_db_posts_id){comment_count++;}}
        html += '<span class=" float-right"><span class="badge badge-light mr-1 "><i class="fas fa-comments mr-1"></i>'+comment_count+'</span>';comment_count = 0;
        html += '<span class="badge badge-light"><i class="fas fa-eye mr-1"></i>'+data['posts'][i].pencil_db_posts_views+'</span></span></p></div>'+
                '<div class="card-body p-0 pl-3 pr-3"><p class="card-title">'+data['posts'][i].pencil_db_posts_title+'</p></a></div>';
        for(j=0; j<data['users'].length; j++){
            if(data['posts'][i].pencil_db_posts_user_id == data['users'][j].pencil_db_users_id){
              html +='<div class="card-footer p-2"><p><span><img src="http://localhost/pencil/assets/images/profile/'+data['users'][j].pencil_db_users_image+'" class="rounded-circle img-fluid mr-1" style="height: 30px;width: 30px;"></span>'+
                     '<span class="badge badge-light">'+data['users'][j].pencil_db_users_username+'</span>';}}
        html +='<span class="badge float-right badge-light"><i class="fas fa-clock mr-1"></i>'+data['posts'][i].pencil_db_posts_created_date+'</span></p></div></div></div>';
        }html += "</section>";}$(".blog-body").html(html);
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
                  toastr.error("Post Deleted!");
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
                  toastr.error("Category Deleted!");
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
                                    '<td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' id="block_btn" class="btn btn-danger shadow "><i class="fas fa-user-minus"></i></button></td>'+
                                    ' <form action="">'+
                                    ' <td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-danger shadow user_delete"><i class="fas fa-trash-alt"></i></button></td>'+
                                    '</form>'+
                                    '</tr>';
                        }else{
                            // if the user is not active show unblock button
                            html += '<tr>'+
                                    '<td>'+data[i].pencil_db_users_username+'</td>'+
                                    '<td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' id="unblock_btn" class="btn btn-success shadow "><i class="fas fa-user-plus"></i></button></td>'+
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
          $('section').on('click', '#create_category_btn', function(event){
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
                          toastr.success("Category Created!");
                        }
                    });
            }else{
              toastr.warning("Field empty!");
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
                    toastr.error("User Deleted!");

                 
                  },
                  error: function () {
                    alert("ajax error");
                  }
                  
                });
               

          });
          

        }

        function block_user(){
        $('#show_user_data').on('click', '#block_btn', function(event){
              event.preventDefault();
              var id = $(this).attr('data');
              $.ajax({
                type: 'POST',
                url: 'http://localhost/pencil/users/block',
                data:{id:id},
                dataType: 'text',
                success: function (response) {
                  
                    show_all_users();
                    toastr.warning("User Blocked!");
                   

                 
                  },
                  error: function () {
                    alert("ajax error");
                  }
                  
                });
               

          });
          

        }

        function unblock_user(){
        $('#show_user_data').on('click', '#unblock_btn', function(event){
              event.preventDefault();
              var id = $(this).attr('data');
              $.ajax({
                type: 'POST',
                url: 'http://localhost/pencil/users/unblock',
                data:{id:id},
                dataType: 'text',
                success: function (response) {
                  
                    show_all_users();
                    toastr.success("User Unblocked!");
                   

                 
                  },
                  error: function () {
                    alert("ajax error");
                  }
                  
                });
               

          });
          

        }


        // search box
        function search_box(){
          var html ="";
          $(".nav_search_btn").on('click', function (event) {
          $("#search_result_box").slideDown(200);
          var search_term = $("#nav_search_box").val().trim();
          if(search_term == ""){
            html = "<p class='lead text-center m-5'>Field Is Empty, Type Some Keywords!</p>";
            html += "<hr><div class='d-flex justify-content-center'><button id='search_box_close' class='btn shadow-lg btn-danger btn-lg'><i class='fas shadow-lg fa-times fa-2x'></i></button></div><br>";
            $("#search_result_box").html(html);
          }else{
                $.ajax({
                type: 'post',
                url: "http://localhost/pencil/posts/search",
                dataType: 'json',
                data: {search_term: search_term},
                success: function (data){ 
                     var comment_count = 0;
                     html = "<p class='lead text-center m-5'>No Posts Matching Current Keyword!</p>";
                     html += "<hr><div class='d-flex justify-content-center'><button id='search_box_close' class='btn shadow-lg btn-danger btn-lg'><i class='fas shadow-lg fa-times fa-2x'></i></button></div><br>";
                      if(data['posts'].length > 0){        
                      html = '<section class="row d-flex justify-content-center">';
                      for(i=0; i<data['posts'].length; i++){
                      html += '<div class="card-deck col-lg-4"><div class="card shadow-lg faster animated zoomIn p-0 m-3"><a href="http://localhost/pencil/posts/'+data['posts'][i].pencil_db_posts_slug+'" data="'+data['posts'][i].pencil_db_posts_id+'"'+
                              ' class="the_read_more_btn" style="color: #000">'+
                              '<img src="http://localhost/pencil/assets/images/posts/'+data['posts'][i].pencil_db_posts_post_image+'" class="w-100 card-img img-fluid" style="height: 200px;">'+
                              '<div class="card-header p-2"><p><span class="badge badge-light"><i class="fas fa-tags mr-1"></i>'+data['posts'][i].pencil_db_categories_name+'</span>';                    
                      if(data['comments'].length == false)
                        data['comments'].length = 0;          
                      for(k=0; k<data['comments'].length; k++){
                        if(data['comments'][k].pencil_db_comments_post_id === data['posts'][i].pencil_db_posts_id){
                          comment_count++;}}
                      html += '<span class=" float-right"><span class="badge badge-light mr-1 "><i class="fas fa-comments mr-1"></i>'+comment_count+'</span>';comment_count = 0;
                      html += '<span class="badge badge-light"><i class="fas fa-eye mr-1"></i>'+data['posts'][i].pencil_db_posts_views+'</span></span></p></div>'+
                              '<div class="card-body p-0 pl-3 pr-3"><p class="card-title">'+data['posts'][i].pencil_db_posts_title+'</p></a></div>';
                      for(j=0; j<data['users'].length; j++){
                          if(data['posts'][i].pencil_db_posts_user_id == data['users'][j].pencil_db_users_id){
                            html +='<div class="card-footer p-2"><p><span><img src="http://localhost/pencil/assets/images/profile/'+data['users'][j].pencil_db_users_image+'" class="rounded-circle img-fluid mr-1" style="height: 30px;width: 30px;"></span>'+
                                   '<span class="badge badge-light">'+data['users'][j].pencil_db_users_username+'</span>';}}
                      html +='<span class="badge float-right badge-light"><i class="fas fa-clock mr-1"></i>'+data['posts'][i].pencil_db_posts_created_date+'</span></p></div></div></div>';}html += "</section>";}
                      $("#search_result_box").html(html);search_term = "";
                      $('.the_read_more_btn').on('click', function(){
                      $("#nav_search_box").val('');});
                },error: function () {console.log("my bad from search box");}});}});
        }
        

      
  });





        