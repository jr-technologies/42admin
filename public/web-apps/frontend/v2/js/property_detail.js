/**
 * Created by jrpro_000 on 8/1/2016.
 */

$(document).on('click','.add-to-favorite',function(){
    var addedClass = $(this).hasClass( "added" );
    if(addedClass == true)
    {
        var property_id = $(this).attr('property_id');
        var user_id = $(this).attr('user_id');
        var key = $(this).attr('key');
        $.ajax({
            type: "POST",
            url: apiPath.concat("favourite/property/delete"),
            data:{
                propertyId:property_id,userId:user_id
            },
            headers: {
                Authorization: key
            },
            success: function(response) {
         $('.add-to-favorite').closest('a').removeClass('added');
      },
            error: function () {
         $('.popup-opener').closest('li').addClass('popup-holder');
      }

        });
    }
    else {
        var property_id = $(this).attr('property_id');
        var key = $(this).attr('key');
        $.ajax({
            type: "POST",
            url: apiPath.concat("favourite/property"),
            data: {
                propertyId: property_id
            },
            headers: {
                Authorization: key
            },
            success: function(response) {
                $('.add-to-favorite').closest('a').addClass('added');
            }
        })
    }
});
