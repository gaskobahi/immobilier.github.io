function getanoncevalid(id){
    var expire;

    /*$('.btnannonceretirer_'+id).on('change',function(e) {
        e.preventDefault();*/
        if ($('.btnannonceretirer_'+id).is(":checked")){
            $('.btnannonceretirer_'+id).val('1');
            expire=$('.btnannonceretirer_'+id).val();
            //alert(val);
        }else {
            $('.btnannonceretirer_'+id).val('0');
            expire=$('.btnannonceretirer_'+id).val();
        }
        $.ajax({
            method:'POST',
            url:urlexpirestatutannonce,
            data:{
                id:id,
                expire:expire,
                _token:tok
            }}).done(function(msg) {
            $('.etatpublicationannonce_'+msg['id']).empty();
            $('.updatedexpireby_publicationannonce_'+msg['id']).empty();
            $('.updatedexpireby_publicationannonce_'+msg['id']).html(msg['updatedexpire_by']);
            if(msg['expire']==1){
                $('.etatpublicationannonce_'+msg['id']).html('Expirée');
                $('.btnannonceretirer_'+msg['id']).attr('checked',true);
            }else{
                $('.etatpublicationannonce_'+msg['id']).html('Activée');
                $('.btnannonceretirer_'+msg['id']).attr('checked',false);
            }
        }).fail(function (jqxhr) {
            var errors = jqxhr.responseJSON;
            alert(errors);

        });

    //});
}
