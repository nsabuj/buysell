$(document).ready(function(){
    $('.ad_photo_delete').click(function() {
       var ad_img_id=parseInt($(this).attr('id'));


        $.ajax({
            type: "POST",
            url:'/delete_ad_image',
            data: {ad_img_id: ad_img_id},
            success: function( data ) {
              if(data==1){
                   $('.'+ad_img_id).remove();
              }
            }

        });


    });

});