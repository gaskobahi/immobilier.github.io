function emptydatatitreproprieteform() {
    $('.nametitrpropriete').val('');
    //$('#proprietaire_id:selected').val('');
    //alert(txt);
    //$("#proprietaire_id option:selected").val('');
    //$("#proprietaire_id option:selected").text('html','Choisir le propriétaire');
    //$("#proprietaire_id option:selected").html('Choisir le propriétaire');

    //$('#proprietaire_id:selected').find('option').text();
    $('#piece').val('');
    $('.error_add_titrepropriete').empty();
}

$('#addtitreproprieteformcreate').on('click',function (e){
    e.preventDefault();
    $('#add-modal_titrepropriete').modal();
    $("form").submit(function(event){
        event.preventDefault();
        if($('.nametitrpropriete').val()===''){
            $('.nametitrpropriete').focus();
            $('.error_add_titrepropriete').empty();
            $('.error_add_titrepropriete').append('<label class="label label-danger">Ce champ code ne doit pas être vide</label>');
        }else {
            if ($('#proprietaire_id').find('option:selected').val() === '') {
                $('#proprietaire_id').find('option:selected').focus();
                $('.error_add_titrepropriete').empty();
                $('.error_add_titrepropriete').append('<label class="label label-danger">Ce champ propriétaire ne doit pas être vide</label>');
            } else {
                if ($('#piece').val() === '') {
                    $('#piece').focus();
                    $('.error_add_titrepropriete').empty();
                    $('.error_add_titrepropriete').append('<label class="label label-danger">Ce champ pièce ne doit pas être vide</label>');
                } else {
                       var data = new FormData($(this)[0]);
                    $('.error_add_titrepropriete').empty();
                    $.ajax({
                        processData : false,
                        contentType : false,
                        method: 'POST',
                        url: urltitrepropriete,
                        data:data,
                        _token: token
                    }).done(function (msg) {
                      $('#titrepropriete_id').append(' <option  value="' + msg['id'] + '">' + msg['name']+' ' +msg['proprietairename']+' '+ msg['proprietairesurname']+' / '+msg['proprietairephone1']+' </option>');
                        //assigner les nouvelles valeur dans le tableau
                        $.notify({
                            icon: 'glyphicon glyphicon-warning-sign',
                            message: msg['message']
                        }, {
                            type: "success"
                        });
                        emptydatatitreproprieteform();
                        $('#add-modal_titrepropriete').modal('hide');
                    }).fail(function (jqxhr) {
                        var errors = jqxhr.responseJSON;
                        errorform = errors;
                        for (i in errorform) {
                            errnam = errorform[i];
                            $('.error_add_titrepropriete').append('<p class="alert-danger" align="center">' + errnam + '</p> ');
                        }
                    });
                }
            }
        }


    });

});
