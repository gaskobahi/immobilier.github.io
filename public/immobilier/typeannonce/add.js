
function emptydatatpannonce() {
    $('.nametp').val('');
    $('.error_add_typeannonce').empty();
}
$('#addtypeannonceformcreate').on('click',function (e){
    e.preventDefault();
    $('#add-modal-typeannonce').modal();

    $('#typeannonce_add_save').on('click',function (e){
        e.preventDefault();
        if($('.nametp').val()==='')
        {
            $('.nametp').focus();
            $('.error_add_typeannonce').empty();
            $('.error_add_typeannonce').append('<label class="label label-danger">Ce champ ne doit pas être vide</label>');
        }else{
            namer=$('.nametp').val();
             $('.error_add_typeannonce').empty();
            $.ajax({
                method:'POST',
                url:urltpannonce,
                data:{
                    name:namer,
                    _token:token
                }
            }).done(function (msg) {
                $('#typeannonce_id').append(' <option  value="'+msg['id']+'">'+ msg['name']+' </option>');
                //assigner les nouvelles valeur dans le tableau
                $.notify({
                    icon: 'glyphicon glyphicon-warning-sign',
                    message: msg['message']
                },{
                    type: "success"
                });
                $('#add-modal-typeannonce').modal('hide');
            }).fail(function (jqxhr) {
                var errors = jqxhr.responseJSON;
                //assigner le resultats dans une variable globale
                errorform = errors;
                //Afficher le message d'erreur
                for(i in errorform){
                    errnam=errorform[i];
                    $('.error_add_typeannonce').append( '<p class="alert-danger" align="center">'+ errnam+'</p> ');
                }
            });
        }


    });

});




//////////////////////////////////////////////////////////////////


