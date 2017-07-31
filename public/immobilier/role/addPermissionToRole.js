$('#role_edit_save').on('click',function (e) {
    e.preventDefault();
    var  valformNom=0;
    valformNom=$('#ajoutpermission option:selected').val();
        if(valformNom<=0){
            alert("Veuillez choisir une permission svp");
        }else{
            selectpermId=valformNom;
            $.ajax({
                method:'POST',
                url:urlpr,
                data:{
                    role:roleid,
                    permission:selectpermId,
                    _token:sess
                }
            }).done(function(msg) {
                if(msg['isdone']===true){
                    pi=msg['permissionId'];
                    pn=msg['permissionName'];
                    $.notify({
                        icon: 'glyphicon glyphicon-warning-sign',
                        message: msg['message']
                    },{
                        type: "success"
                    });
                    $('#tbl tr:last').after("<tr id='permrole_'"+ pi +" > " +
                        "<td id='permrole_'"+pi+'>'+pn+"</td> "+
                        "<td> <a class=' btn btn-danger' href='#' title='Suprimer la permission'  aria-hidden='true'><i class='fa fa-trash-o'></i></a></td>"+
                        "</tr>");
                }
                else {
                    $.notify({
                        icon: 'glyphicon glyphicon-warning-sign',
                        message: msg['message']
                    },{
                        type: "warning"
                    });
                }

            }).fail(function (msg) {
                $.growl.notice({ message: msg['message']});
            });
        }
});