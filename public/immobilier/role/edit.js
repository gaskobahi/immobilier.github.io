var roleId='';
var roleName='';
var roleDipslayName='';
var roleDescription='';

function geteditroleid(id) {
    roleId = $('.a_role_id_'+id).text();
    roleName = $('.a_role_name_'+id).text();
    roleDipslayName = $('.a_role_display_name_'+id).text();
    roleDescription = $('.a_role_description_'+id).text();
    $('#name').val(roleName);
    $('#display_name').val(roleDipslayName);
    $('#description').text(roleDescription);
    $('#edit-modal').modal();
}
$('#role_edit_save').on('click',function (e){
    e.preventDefault()
    $('#name').val();
    if($('#name').val()===''||$('#display_name').val()===''){
        if($('#display_name').val()===''){
            $('#display_name').focus();
        }
        if($('#name').val()===''){
            $('#name').focus();
        }

        $('.error_edit').empty();
        $('.error_edit').append('<label class="label label-danger">Ce champ ne doit pas être vide</label>');
    }else{
        namer=$('#name').val();
        displeditname =$('#display_name').val();
        roleeditdescrip =$('#description').val();
        $('.error_edit').empty();
        $.ajax({
            method:'GET',
            url:url,
            data:{
                id:roleId,
                name:namer,
                display_name:displeditname,
                description:roleeditdescrip,
                roleId:roleid,
                _token:token
            }
        }).done(function (msg) {
            //assigner les nouvelles valeur dans le tableau
            $('.a_role_name_'+msg['id']).text(msg['name']);
            $('.a_role_display_name_'+msg['id']).text(msg['displayname']);
            $('.a_role_description_'+msg['id']).text(msg['description']);
            $('#edit-modal').modal('hide');

        }).fail(function (jqxhr) {
            var errors = jqxhr.responseJSON;
            //alert(errors);
            //assigner le resultats dans une variable globale
            errorform = errors;
            //Afficher le message d'erreur
           // $('.error_role_edit').empty();
           // $('.error_role_edit').addClass('alert alert-danger');
            for(i in errorform){
                errnam=errorform[i];
                $('.error_edit').append( '<p class="alert-danger" align="center">'+ errnam+'</p> ');
            }
        });

    }


});



//////////////////////////////////////////////////////////////////


