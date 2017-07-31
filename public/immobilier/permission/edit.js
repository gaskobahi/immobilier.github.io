var permissionId='';
var permissionIdName='';
var permissionIdDipslayName='';
var permissionIdDescription='';

function geteditpermissionid(id) {
    permissionId = $('.a_permission_id_'+id).text();
    permissionIdName = $('.a_permission_name_'+id).text();
    permissionIdDipslayName = $('.a_permission_display_name_'+id).text();
    permissionIdDescription = $('.a_permission_description_'+id).text();
    $('#name').val(permissionIdName);
    $('#display_name').val(permissionIdDipslayName);
    $('#description').text(permissionIdDescription);
    $('#edit-modal').modal();
}

$('#permission_edit_save').on('click',function (e){
    e.preventDefault();
    if($('#name').val()===''||$('#display_name').val()===''){
        if($('#name').val()===''){
            $('#name').focus();
        }
        if($('#display_name').val()===''){
            $('#display_name').focus();
        }
        $('.error_edit').empty();
        $('.error_edit').append('<label class="label label-danger">Ce champ ne doit pas être vide</label>');
    }else{
        namer=$('#name').val();
        displeditname =$('#display_name').val();
        permissioneditdescrip =$('#description').val();
        $('.error_edit').empty();
        $.ajax({
            method:'GET',
            url:url,
            data:{
                id:permissionId,
                name:namer,
                display_name:displeditname,
                description:permissioneditdescrip,
                _token:token
            }
        }).done(function (msg) {
            //assigner les nouvelles valeur dans le tableau
            $('.a_permission_name_'+msg['id']).text(msg['name']);
            $('.a_permission_display_name_'+msg['id']).text(msg['displayname']);
            $('.a_permission_description_'+msg['id']).text(msg['description']);
            $('#edit-modal').modal('hide');

        }).fail(function (jqxhr) {
            var errors = jqxhr.responseJSON;
            //assigner le resultats dans une variable globale
            errorform = errors;
            //Afficher le message d'erreur
              for(i in errorform){
                errnam=errorform[i];
                $('.error_edit').append( '<p class="alert-danger" align="center">'+ errnam+'</p> ');
            }
        });
    }
});
