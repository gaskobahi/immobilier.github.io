var typeannonceId=0;
var typeannonceName='';
function getdeletetypeannonceid(id) {
    typeannonceId = $('.tpaid_' + id).text();
    typeannonceName = $('.tpaname_' + id).text();
    bootbox.confirm({
        title: "Confirmation de la suppression?",
        message: 'Etes vous-sûr de vouloir suppprimer <label class="btn alert-danger">' + typeannonceName + '? </label>',
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
                url:url,
                data:{
                    id:typeannonceId,
                    name:typeannonceName,
                    _token:token
                }}).done(function(msg) {
                  if(msg['statut']===false) {
                      $.notify({
                          // options
                          icon: 'glyphicon glyphicon-warning-sign',
                          message: msg['message']
                      },{
                          type: "danger"
                      });
                  }else{
                      $('.tpannonce_'+msg['id']).remove();
                      $.notify({
                          // options
                          icon: 'glyphicon glyphicon-warning-sign',
                          message: msg['message']
                      },{
                          type: "success"
                      });
                  }


                /////////suprimer la div error///////////
            }).fail(function (jqxhr) {
                var errors = jqxhr.responseJSON;
                alert(errors);

            });
        }
        }
});
}





/*function gettypeannonceid(id){
    rolei=$('.tpaname_' + id).text();
    roleName = $('#role_name_' + id).text();
    var divmessdel=$('<div class="alert alert-danger alert-dismissible"><h4 align="center">Voulez vous vraiment supprimer '+roleName+'</h4></div>');
    $('#mydeleterolemodel').append(divmessdel);
    $( "#pupopdeleterole" ).modal();

}*/


/*$('.a_typeannonce_delete_'+idr).on('click',function (e) {
    var id = $(this).attr("class");
    alert(id);
});*/