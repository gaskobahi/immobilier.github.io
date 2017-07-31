@extends('layouts.backend.base')
@section('title')
    Permission
@endsection
@section('content')
    <script>
        var permissionid=0,namer="",displeditname,permissioneditdescrip,errorform,errnam=[];

        //appel du formulaire modal ansi que les infos affivher daans le table

        var  token='<?php echo e(Session::token()); ?>';
        var url='<?php echo (route('permission.edit')); ?>';
        function effaceDivError(){
            $('.error_edit').removeClass('alert alert-danger').empty();
        }

    </script>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Permission
                    @if(Auth::user()->role->hasPermission('add-permission'))
                    <a class="btn btn-primary" href="{{route('permission.create')}}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Ajouter
                    </a>
                    @endif
                </h2>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Entrer un nom...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Aller!</button>
                          </span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="title_left">
                    @include('flash')
                </div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">Identifiant </th>
                            <th class="column-title">Nom</th>
                            <th class="column-title">Nom à afficher</th>
                            <th class="column-title">Description</th>
                            <th class="column-title">Crée le) </th>
                            <th class="column-title">Modifié le </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($permissions as $permission)
                            <tr class="even pointer">
                                <td  class=" a_permission_id_{{$permission->id}}">{{$permission->id}}</td>
                                <td  class="a_permission_name_{{$permission->id}}">{{$permission->name}}</td>
                                <td  class="a_permission_display_name_{{$permission->id}} ">{{$permission->display_name}}</td>
                                <td   class="a_permission_description_{{$permission->id}} ">{{$permission->description}}</td>
                                <td class=" ">{{$permission->created_at}}</td>
                                <td class="a_permission_updated_{{$permission->id}}">{{$permission->updated_at}}</td>
                                <td class=" last">
                                    @if(Auth::user()->role->hasPermission('edit-permission'))
                                    <a onclick="geteditpermissionid({{$permission->id}})"><i class="fa fa-edit"></i></a>
                                    @endif
                                     @if(Auth::user()->role->hasPermission('delete-permission'))
                                        <a href="{{route('user.delete',$permission->id)}}" ><i class="fa fa-trash-o"></i></a>
                                    @endif
                                    <a href="#"><i class="fa fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$link}}
                </div>
            </div>
        </div>
    </div>
    <!-- Fenetre modal-->
    <div class="modal  fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">*</button>
                    <h5 id="myModalLabel">Modification de Permission</h5>
                </div>
                <form class="form-horizontal" >
                    <div class="modal-body">
                        <div class="error_edit "></div>
                        <div id="error_permission_edit_name" class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nom*</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"  value="{{ old('name') }}" >
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="error_permission_edit_display_name" class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nom à afficher</label>
                            <div class="col-md-6">
                                <input id="display_name" type="text" class="form-control" name="display_name"  value="{{ old('display_name') }}" >
                                @if ($errors->has('display_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description"  class="form-control col-md-7 col-xs-12" name="description"></textarea>
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
                                <button onclick="effaceDivError()" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                                    <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fermer
                                </button>
                                <button type="button" id="permission_edit_save" class="btn btn-success"  aria-hidden="true">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Enrégistrer</button>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="{{Session::token()}}">
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('immobilier/permission/edit.js')}}"></script>
@endsection


