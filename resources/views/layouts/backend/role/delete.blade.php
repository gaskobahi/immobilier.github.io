
<script>
    var roleName, roleid=0;
    ///////////afficher la fenetre modal de suppression

    ////////////////////////
   $('.delrol').on('click',function(e){
       e.preventDefault();
       $( "#pupopdeleterole" ).dialog({
           autoOpen: false,
           width: 200,
           buttons: [
               {

                   text: "Oui",

                   click: function () {

                       window.location.href = targetUrl;

                   }

               }  ,
               {
                   text: "Non",
                   click: function() {
                       $( this ).dialog( "close" );
                   }
               }
           ]
       });

       //$('#deleterole-modal').modal();
       $( "#pupopdeleterole" ).dialog( "open" );

   });
////afficher le message demendant a l'utilisateur de confirmer sa suppresion
   function deleteRole(id){
       roleid=$('#role_id_' + id).text();
       roleName = $('#role_name_' + id).text();
       var divmessdel=$('<div class="alert alert-danger alert-dismissible"><h4 align="center">Voulez vous vraiment supprimer '+roleName+'</h4></div>');
       $('#mydeleterolemodel').append(divmessdel);
   }
////////////////vide le conenu de la div
   function emptydiv() {
       $('#mydeleterolemodel').empty();
   }

    var  token='{{Session::token()}}';
    var url='{{route('role.destroy')}}';




</script>


<div class="modal  fade" tabindex="-1" role="dialog" id="deleterole-modal">
    <div class="modal-dialog" >


            <div class="modal-body" id="mydeleterolemodel">

            </div>

            <div class="modal-footer">

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">

                        <button type="button" id="role_delete_save" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Oui</button>
                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="emptydiv()">
                            <i class="fa fa-times-circle-o" aria-hidden="true"></i> Non
                        </button>

                    </div>
                </div>
            </div>
            <input type="hidden" name="token" value="{{Session::token()}}">
        </div>
    </div>
</div>