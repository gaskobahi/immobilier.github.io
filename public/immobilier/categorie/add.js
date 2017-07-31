
function emptydatacategorie() {
    $('.name').val('');
    $('.error_add_categorie').empty();
}

$('#addcategorieonformcreate').on('click',function (e){
    e.preventDefault();
    $('#add-modal-categorie').modal();

    $('#categorie_add_save').on('click',function (e){
        e.preventDefault();
        if($('.name').val()===''){
            $('.name').focus();
            $('.error_add_categorie').empty();
            $('.error_add_categorie').append('<label class="label label-danger">Ce champ ne doit pas être vide</label>');
        }else{
            namer=$('.name').val();
            $('.error_add_categorie').empty();
            $.ajax({
                method:'POST',
                url:urlcat,
                data:{
                    name:namer,
                    _token:token
                }
            }).done(function (msg) {
                $('#categorie_id').append(' <option  value="'+msg['id']+'">'+ msg['name']+' </option>');
                $.notify({
                    icon: 'glyphicon glyphicon-warning-sign',
                    message: msg['message']
                },{
                    type: "success"
                });
                $('.name').val('');
                $('#add-modal-categorie').modal('hide');
            }).fail(function (jqxhr) {
                var errors = jqxhr.responseJSON;
                //assigner le resultats dans une variable globale
                errorform = errors;
                //Afficher le message d'erreur
                for(i in errorform){
                    errnam=errorform[i];
                    $('.error_add_categorie').append( '<p class="alert-danger" align="center">'+ errnam+'</p> ');
                }
            });

        }


    });
});




//////////////////////////////////////////////////////////////////


