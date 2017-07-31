function supprimerPermissionRole(id) {
    pr_permission_id=id;
    pr_permission_n=$('#permroleN_'+id).text();
    bootbox.confirm({
        title: "Confirmation de la suppression?",
        message: 'Etes vous-sûr de vouloir retirer <label class="alert-danger">' +pr_permission_n +' </label> à  <label class="alert-success">'+roleNamep+ '</label>? ',
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Annuler'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirmer'
            }
        },
        callback: function (result) {
            if(result===true){
                $.ajax({
                    method:'POST',
                    url:urlrperm,
                    data:{
                        roleId:roleid,
                        permissionId:pr_permission_id,
                        permissionName:pr_permission_n,
                        _token:prtok
                    }}).done(function(msg) {
                    $('#permrole_'+msg['perm_id']).remove();
                    $.notify({
                        icon: 'glyphicon glyphicon-warning-sign',
                        message: msg['message']
                    },{
                        type: "success"
                    });
                      }).fail(function (jqxhr) {
                    var errors = jqxhr.responseJSON;
                    alert(errors);
                });
            }
        }
    });
}

/*
function retirerlemsgdesuppression() {
    $('#infodelpermRole').remove();
}
*/



