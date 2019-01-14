
  // anim js functions for animations
  $(document).ready(function(e){

       // file upload style
       bsCustomFileInput.init();

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

      show_all_users();
      get_posts_by_category();
      delete_user();
      block_and_unblock_user();
      

      // category filetering using checkbox function

      function get_posts_by_category(){



              $('#category_filter_submit').click(function(){

                  // prevent default behaviour of submit button
                  event.preventDefault();


                  var category_id = [];

                  $("input[name='category_name']:checked").each(function(i){
                      category_id[i] = $(this).val();
                  });

                  var JSON_cat = JSON.stringify(category_id);

                  // ajax to get posts based on selected categories
                  $.ajax({
                              url:"http://localhost/pencil/posts/card",
                              data: {category: JSON_cat},
                              type:'POST',
                              success:function(data){

                                  $('.blog-body').html(data);
                              }
                            });

                });

            }

      


      //function show all product
        function show_all_users(){
            $.ajax({
                type  : 'ajax',
                url   : 'http://localhost/pencil/users/profile_user_list',
                async : true,
                dataType : 'json',
                success : function(data){

                  if(data.length > 1){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){

                      // only show non admins
                      if(data[i].pencil_db_users_is_admin == "no"){

                        // if the user is active show block button
                        if(data[i].pencil_db_users_is_active == "yes"){
                            html += '<tr>'+
                                    '<td>'+data[i].pencil_db_users_username+'</td>'+
                                    '<td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-danger block_btn"><i class="fas fa-user-minus"></i></button></td>'+
                                    ' <form action="">'+
                                    ' <td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-danger user_delete"><i class="fas fa-trash-alt"></i></button></td>'+
                                    '</form>'+
                                    '</tr>';
                        }else{
                            // if the user is not active show unblock button
                            html += '<tr>'+
                                    '<td>'+data[i].pencil_db_users_username+'</td>'+
                                    '<td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-success unblock_btn"><i class="fas fa-user-minus"></i></button></td>'+
                                    ' <form action="">'+
                                    ' <td class="col"><button type="submit" data='+data[i].pencil_db_users_id+' class="btn btn-danger user_delete"><i class="fas fa-trash-alt"></i></button></td>'+
                                    '</form>'+
                                    '</tr>';
                        }
                      }
                    }
                    $('#show_user_data').html(html);
                }
              }
 
            });
        }


        // delete user by ajax
      function delete_user(){

        $('#show_user_data').on('click', '.user_delete', function(e){
          event.preventDefault();
              var id = $(this).attr('data');
              $.ajax({
                type: 'ajax',
                method: 'POST',
                async: false,
                url: 'http://localhost/pencil/users/delete',
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





        