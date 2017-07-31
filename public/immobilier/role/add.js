var roleId='';
var roleName='';
var roleDipslayName='';
var roleDescription='';

$('#addroleonformcreate').on('click',function (e){
    e.preventDefault();
    $('#add-modal').modal();

    $('#role_add_save').on('click',function (e){
        e.preventDefault();
        if($('.name').val()===''|| $('.display_name').val()===''){
            if($('.display_name').val()===''){
                $('.display_name').focus();
            }
            if($('.name').val()===''){
                $('.name').focus();
            }
            $('.error_add').empty();
            $('.error_add').append('<label class="label label-danger">Ce champ ne doit pas être vide</label>');

        }else{
            namer=$('.name').val();
            displeditname =$('.display_name').val();
            roleeditdescrip =$('.description').val();
            $('.error_add').empty();
            $.ajax({
                method:'POST',
                url:url,
                data:{
                    name:namer,
                    display_name:displeditname,
                    description:roleeditdescrip,
                    _token:token
                }
            }).done(function (msg) {
                $('#role_id').append(' <option  value="'+msg['id']+'">'+ msg['name']+' </option>');
                //assigner les nouvelles valeur dans le tableau
                $.notify({
                    icon: 'glyphicon glyphicon-warning-sign',
                    message: msg['message']
                },{
                    type: "success"
                });
                $('#add-modal').modal('hide');
            }).fail(function (jqxhr) {
                var errors = jqxhr.responseJSON;
                //assigner le resultats dans une variable globale
                errorform = errors;
                //Afficher le message d'erreur
                for(i in errorform){
                    errnam=errorform[i];
                    $('.error_add').append( '<p class="alert-danger" align="center">'+ errnam+'</p> ');
                }
            });

        }


    });

});




//////////////////////////////////////////////////////////////////


