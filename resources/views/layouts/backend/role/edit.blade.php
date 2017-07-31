
<script>
   var roleid=0,namer,displeditname,roleeditdescrip,errorform,errnam=[];

    //appel du formulaire modal ansi que les infos affivher daans le table

   var  token='{{Session::token()}}';
   var url='{{route('role.edit')}}';
    function effaceDivError(){
        $('.error_edit').removeClass('alert alert-danger').empty();
    }

</script>


<div class="modal  fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">*</button>
                <h5 id="myModalLabel">Modification du rôle</h5>
            </div>
            <form class="form-horizontal" >

                <div class="modal-body">
                    <div class="error_edit "></div>
                    <div id="error_role_edit_name" class="form-group">
                        <label class="col-md-4 control-label">Nom*</label>
                        <div class="col-md-6">
                            <input id="rolename" type="text" class="form-control" name="name"  value="{{ old('name') }}" >

                        </div>
                    </div>

                    <div id="error_role_edit_display_name" class="form-group">
                        <label class="col-md-4 control-label">Nom à afficher</label>
                        <div class="col-md-6">
                            <input id="display_name" type="text" class="form-control" name="display_name"  value="{{ old('display_name') }}" >
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Description</label>
                        <div class="col-md-6">
                            {!! Form::textarea ('description', null, ['class' => 'form-control','id'=>'description', 'placeholder' => 'Entrez la description ']) !!}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">

                            <button type="button" id="role_edit_save" class="btn btn-primary"  aria-hidden="true">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Enrégistrer</button>
                            <button onclick="effaceDivError()" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                                <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fermer
                            </button>

                        </div>
                    </div>
                </div>
                <input type="hidden" name="token" value="{{Session::token()}}">
            </form>
        </div>
    </div>
</div>
