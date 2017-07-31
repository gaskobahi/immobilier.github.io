/*
function  getannonceidforshowdetail(id){
    var annonceId=id;

    $.ajax({
        method:'GET',
        url:urldetail,
        data:{
            id:annonceId,
            _token:token
        }}).done(function(msg) {
        //alert(urldetail);
        //alert(msg['message']);
    }).fail(function (jqxhr) {
        var errors = jqxhr.responseJSON;
        alert(errors);

    });
}
*/

$('.imageAnnonceToSlide').on('click',function (e) {
    //alert($(this).find('img').first().attr('src'));
    var imapath=$(this).find('img').first().attr('src');
    $('.product-image').find('img').attr('src',imapath);
});