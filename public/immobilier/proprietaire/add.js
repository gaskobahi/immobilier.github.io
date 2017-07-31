
function emptydataproprietaireform() {
  $('#nameprop').val('');
  $('#surnameprop').val('');
  //$('.sexeprop:checked').val('');
  $('#phone1prop').val('');
  $('#phone2prop').val('');
  //$('#ville_idprop').find('option:selected').val('');
  $('.error_add_proprietaire').empty();
}

$('.addproprietaireformcreate').on('click',function (e){
    e.preventDefault();
    $('.add-modal_proprietaire').modal();
    var name,surname,sexe,phone1prop,phone2prop,ville_idprop;
    $('#proprietaire_add_save').on('click',function (){
        if(validateformNameandSurnamePhone1Villeproprietaire()===true){
            name=$('#nameprop').val();
            surname=$('#surnameprop').val();
            sexe=$('.sexeprop:checked').val();
            phone1prop=$('#phone1prop').val();
            phone2prop=$('#phone2prop').val();
            ville_idprop=$('#ville_idprop').find('option:selected').val();
            $('.error_add_proprietaire').empty();
            $.ajax({
                method:'POST',
                url:urltproprietaire,
                data:{
                    name:name,
                    surname:surname,
                    sexe:sexe,
                    phone1:phone1prop,
                    phone2:phone2prop,
                    ville_id:ville_idprop,
                    _token:token
                }
            }).done(function (msg) {
                $('#proprietaire_id').append(' <option  value="'+msg['id']+'">'+ msg['name']+' '+msg['surname']+' / '+msg['phone1']+' </option>');
                //assigner les nouvelles valeur dans le tableau
                $.notify({
                    icon: 'glyphicon glyphicon-warning-sign',
                    message: msg['message']
                },{
                    type: "success"
                });
                emptydataproprietaireform();
                $('.add-modal_proprietaire').modal('hide');

            }).fail(function (jqxhr) {
                var errors = jqxhr.responseJSON;
                //assigner le resultats dans une variable globale
                errorform = errors;
                //Afficher le message d'erreur
                for(i in errorform){
                    errnam=errorform[i];
                    $('.error_add_proprietaire').append( '<p class="alert-danger" align="center">'+ errnam+'</p> ');
                }
            });

        }

    });

});



function validateformNameandSurnamePhone1Villeproprietaire(){
    if($('#nameprop').val()===''){
        $('#nameprop').focus();
        $('.error_add_proprietaire').empty();
        $('.error_add_proprietaire').append('<label class="label label-danger">Ce champ nom ne doit pas être vide</label>');
    }else{
        if ($('#surnameprop').val() === '') {
            $('#surnameprop').focus();
            $('.error_add_proprietaire').empty();
            $('.error_add_proprietaire').append('<label class="label label-danger">Ce champ prénom(s) ne doit pas être vide</label>');
        }else {
            if($('#phone1prop').val()===''){
                $('#phone1prop').focus();
                $('.error_add_proprietaire').empty();
                $('.error_add_proprietaire').append('<label class="label label-danger">Ce champ Téléphone ne doit pas être vide</label>');
            }else{
                if($('#ville_idprop').find('option:selected').val() === ''){
                    $('#ville_idprop').focus();
                    $('.error_add_proprietaire').empty();
                    $('.error_add_proprietaire').append('<label class="label label-danger">Ce champ Ville ne doit pas être vide</label>');
                }else{
                   return true;
                     }

            }

        }
    }
}


