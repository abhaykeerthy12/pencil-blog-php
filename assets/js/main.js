
 $('#title_text').hide();
 $('#quote').hide();
 $('#author').hide();
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

      $("#category_filter input[type=checkbox]").click(function(e){

                  var category_id = $(this).val();


                  $.each($("input[name='category_name']:checked"), function(){
               

                     $.ajax({
                          url:"http://localhost/pencil/posts/card",
                          data: {},
                          type:'POST',
                          success:function(data){

                              $('.blog-body').html(data);
                          }
                        });

          });

      });

  });