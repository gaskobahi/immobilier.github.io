@extends('layouts.backend.base')
@section('title')
    Role-Permission
@endsection
@section('content')

<script>
        ////////////////////////script des gestion des attributons de permissions  aux roles
        var selectpermId=0,pi,pn,rmpermid=0,rmroleid=0,rmpermName,prtok;
        var sess='{{Session::token()}}';
        prtok=sess;
        var urlrperm='{{route('permissionrole.detachpermissionfromrole')}}';
        var urlpr='{{route('permissionrole.addpermissiontorole')}}';
        var roleid='{{$rolename->id}}';
        var roleNamep='{{$rolename->name}}';
        var pr_role_id=0,pr_permission_id=0;
        //////////////////////////////////////////////////////////////////////////////
</script>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Attribuer une permission à <strong>{!!$rolename->name!!}</strong></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form class="form-horizontal" >
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="ajoutpermission" class="form-control">
                            <option value="0">Choisissez une permission</option>
                            @foreach($allpermissons as $perm)

                                <option class="ajpermission_{{ $perm->id}}" value={!! $perm->id !!}>
                                    {!! $perm->name !!}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" id="rolpermis_{!!$rolename->name!!}">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="button" id="role_edit_save" class="btn btn-primary"  aria-hidden="true">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Enrégistrer</button>
                        <a  href="javascript:history.back()" class="btn btn-success" data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fermer
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-success">
            <div class=" panel-heading">
                Les permissions de ce rôle <strong>{!!$rolename->name!!}</strong>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table id="tbl" class="table table-striped table-bordered table-hover  ">
                        <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($rpermissions as $rpermission)
                            <tr class="even pointer"  id="permrole_{{ $rpermission->id }}">
                                <td hidden="true" id="permroleid_{{ $rpermission->id }}">{!!$rpermission->id!!} </td>
                                <td id="permroleN_{{ $rpermission->id }}">{!!$rpermission->permissions!!} </td>
                                <td>
                                    <a onclick="supprimerPermissionRole({{$rpermission->id }})" class="btn btn-danger" title="Suprimer la permission"  href="#"  aria-hidden="true">
                                    <i class=" fa fa-trash alert-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{$link}}
            </div>
            <!-- /.panel-body -->
        </div>
</div>

<div class="modal  fade" tabindex="-1" role="dialog" id="permissionrolerm">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class=" modal-body" id="mypermissionrolerm">
            </div>
            <div class="modal-footer">
                <div class="form-group"> <div class="col-md-6 col-md-offset-4">
                        <button type="button" id="permissionrole_delete_save"  class=" btn btn-primary " data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-check-square-o" aria-hidden="true">
                            </i>Oui
                        </button>
                        <button onclick="retirerlemsgdesuppression()" class="btn btn-danger  " data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                            Non
                        </button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="token" value="{{Session::token()}}">
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{asset('immobilier/role/addPermissionToRole.js')}}"></script>
    <script src="{{asset('immobilier/role/detachPermissionFromRole.js')}}"></script>
@endsection