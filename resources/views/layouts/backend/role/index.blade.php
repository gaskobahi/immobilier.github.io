@extends('layouts.backend.base')
@section('title')
    Rôle
@endsection
@section('content')
    <script>
        var roleid=0,namer="",displeditname,roleeditdescrip,errorform,errnam=[];

        //appel du formulaire modal ansi que les infos affivher daans le table

        var  token='<?php echo e(Session::token()); ?>';
        var url='<?php echo (route('role.edit')); ?>';
        function effaceDivError(){
            $('.error_edit').removeClass('alert alert-danger').empty();
        }

    </script>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Rôle
                    @if(Auth::user()->role->hasPermission('add-role'))
                    <a class="btn btn-primary" href="{{route('role.create')}}">
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
                        @foreach($roles as $role)
                            <tr class="even pointer">
                                <td  class=" a_role_id_{{$role->id}}">{{$role->id}}</td>
                                <td  class="a_role_name_{{$role->id}}">{{$role->name}}</td>
                                <td  class="a_role_display_name_{{$role->id}} ">{{$role->display_name}}</td>
                                <td   class="a_role_description_{{$role->id}} ">{{$role->description}}</td>
                                <td class=" ">{{$role->created_at}}</td>
                                <td class="a_role_updated_{{$role->id}}">{{$role->updated_at}}</td>
                                <td class=" last">
                                    @if(Auth::user()->role->hasPermission('edit-role'))
                                    <a class="btn btn-primary" onclick="geteditroleid({{$role->id}})" title="Modifier la permission"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(Auth::user()->role->hasPermission('attribuer-permission-to-role'))
                                        <a class="btn btn-default" href="{{route('role.rolepermissionindex',$role->id)}}" title="Attribution de permission"><i class="fa fa-key"></i></a>
                                   @endif
                                    @if(Auth::user()->role->hasPermission('edit-role'))
                                    <a class="btn btn-danger" href="{{route('user.delete',$role->id)}}" title="Suprimer la permission" ><i class="fa fa-trash-o"></i></a>
                                    @endif
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
    <!-- Fenetre modal role-->
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
                        <div id="error_role_edit_name" class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
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

                        <div id="error_role_edit_display_name" class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
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
                                <button type="button" id="role_edit_save" class="btn btn-success"  aria-hidden="true">
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
    <script src="{{asset('immobilier/role/edit.js')}}"></script>
@endsection
