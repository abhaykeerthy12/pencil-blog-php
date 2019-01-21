
  // anim js functions for animations
  $(document).ready(function(e){
    
        // date picker

        $(function() {
          $('.datetimepicker4').datetimepicker({
            pickTime: false
          });
        });

       // file upload style
       bsCustomFileInput.init();

       $('#edit_card_toggle_btn').click(function(){
        
        if ($(this).text() == "Change Anything?") { 
          $(this).text("Close"); 
         } else { 
          $(this).text("Change Anything?"); 
        }; 

          $('#edit_profile_form').slideToggle();
       });
      
       $("#user_profile_advanced_btn").click(function(){

        if ($(this).text() == "Advanced") { 
          $(this).text("Close"); 
         } else { 
          $(this).text("Advanced"); 
        }; 

         $('#user_profile_advanced').slideToggle();
       });

       $(".category_create_btn").click(function(){

        if ($(this).text() == "Add Category") { 
          $(this).text("Close"); 
         } else { 
          $(this).text("Add Category"); 
        }; 

         $('#create_category_form').slideToggle();
       });

       $(".category_form_close_btn").click(function(event){
         event.preventDefault();

         if ($(".category_create_btn").text() == "Add Category") { 
          $(".category_create_btn").text("Close"); 
         } else { 
          $(".category_create_btn").text("Add Category"); 
        }; 

        $('#create_category_form').slideUp();
       });
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
      
  $(document).ready(function(e){

    if (window.location.pathname == "/pencil/users/profile") {
      show_user_posts();
      show_all_users();    
      show_all_categories();
      delete_user();
      delete_post();
      delete_category();
      block_and_unblock_user();
      
    }

    if (window.location.pathname == "/pencil/posts") {
      get_posts_by_category();
      load_more_posts();
      show_posts();
    }

      // category filetering using checkbox function

      function get_posts_by_category(){
        var postcounter = 1;
        


              $('#category_filter_submit').click(function(){

                  // prevent default behaviour of submit button
                  event.preventDefault();
          postcounter = postcounter + 1;


                  var category_id = [];

                  $("input[name='category_name']:checked").each(function(i){
                      category_id[i] = $(this).val();
                  });

                  if(category_id.length === 0){
                    postcounter = 2;
                  }

                  var JSON_cat = JSON.stringify(category_id);

                  // ajax to get posts based on selected categories
                  $.ajax({
                              url:"http://localhost/pencil/posts/card",
                              data: {category: JSON_cat, nextpostnumber: postcounter},
                              type:'POST',
                              success:function(data){

                                  $('.blog-body').html(data);
                              }
                            });

                });

            }


      // load more button
      function load_more_posts(){
        var postcounter = 1;
        $("#load_more").click(function(){
          postcounter = postcounter + 1;
        
          $(".blog-body").load("http://localhost/pencil/posts/card", {
            nextpostnumber: postcounter
          });
        });
      }

      // show posts
      function show_posts(){
        var postcounter = 1;
       
          $(".blog-body").load("http://localhost/pencil/posts/card", {
            nextpostnumber: postcounter
         
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
          
          console.log('html value',html);
          $('#show_user_posts').html(html);   


        }});
    }
    
    // delete post ajax
    function delete_post(){
      $('#show_user_posts').on('click', '.post_delete', function(e){

        event.preventDefault();
            var id = $(this).attr('data');
            $.ajax({
              type: 'POST',
              async: false,
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
      $('#show_user_category').on('click', '.profile_category_delete_btn', function(e){
        event.preventDefault();
            var id = $(this).attr('data');
            $.ajax({
              type: 'POST',
              async: false,
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


        //function show all product
        function show_all_categories(){
          $.ajax({
              type  : 'ajax',
              url   : 'http://localhost/pencil/users/profile_category_list',
              async : true,
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
        $('#show_user_data').on('click', '.user_delete', function(e){
              var id = $(this).attr('data');
              $.ajax({
                type: 'POST',
                async: false,
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
          $('#show_user_data').on('click', '.block_btn', function(e){
            event.preventDefault();
                var id = $(this).attr('data');
                $.ajax({
                  type: 'ajax',
                  method: 'POST',
                  async: false,
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
            $('#show_user_data').on('click', '.unblock_btn', function(e){
              event.preventDefault();
                  var id = $(this).attr('data');
                  $.ajax({
                    type: 'ajax',
                    method: 'POST',
                    async: false,
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
        

      
  });





        