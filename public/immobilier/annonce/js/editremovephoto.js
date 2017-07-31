function getIdImgToRemove(id){
    var lengthofphoto=$('.imgeditannoncephoto').length;
    if(lengthofphoto>1){
        var photoId=id;
        $.ajax({
            method:'GET',
            url:urldetail,
            data:{
                id:photoId
            }}).done(function(msg) {
            $('.diveditannoncephoto_'+photoId).remove();
            //alert(msg['message']);
        }).fail(function (jqxhr) {
            var errors = jqxhr.responseJSON;
            alert(errors);

        });

    }else{
    $.notify({
        // options
        icon: 'glyphicon glyphicon-warning-sign',
        message: 'Il mois deux photo doivent rester'
    },{
        type: "danger"
    });
    }

}

$('.diveditannoncephotoremove').on('click',function (e) {
    //alert($(this).find('img').first().attr('src'));
    var imapath=$('.diveditannoncephoto').find('.imgeditannoncephoto').attr('src');
    //$('.product-image').find('img').attr('src',imapath);
    //alert(imapath);
});