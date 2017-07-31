@extends('layouts.backend.base')
@section('title')
    Créer un utilisateur
@endsection
@section('css')

@endsection
@section('content')

    <script>
        var roleid=0,namer="",displeditname,roleeditdescrip,errorform,errnam=[];
        //appel du formulaire modal ansi que les infos affivher daans le table
        var  token='<?php echo e(Session::token()); ?>';
        var url='<?php echo (route('permissionrole.roleaddfromregisteruser')); ?>';
    </script>
    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>UTILISATEUR</h3>
                    </div>


                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Creation d'utilisateur <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}"  enctype="multipart/form-data" novalidate>
                                    {{ csrf_field() }}
                                    <span class="section">Information personnel</span>

                                    <div  class="item form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nom" required="required" type="text">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('name')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div  class="item form-group{{ $errors->has('surname') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname">Prénom(s) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="surname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="surname" placeholder="Prénom(s)" required="required" type="text">
                                            @if ($errors->has('surname'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('surname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div  class="item form-group{{ $errors->has('pseudo') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Pseudonyme <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="pseudo" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="pseudo" placeholder="Pseudonyme" required="required" type="text">
                                            @if ($errors->has('pseudo'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('pseudo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Genre
                                            <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="sexe" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" checked="checked" name="sexe" value="m"> &nbsp; Masculin &nbsp;
                                                </label>
                                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="sexe" value="f"> Feminin
                                                </label>
                                            </div>
                                            @if ($errors->has('sexe'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('sexe') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="item form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rôle<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="role_id" name="role_id" class="form-control">
                                                <option value="" selected="selected">Choisir le rôle</option>
                                                @if(Auth::user()->getUserRole()->name=='admin')
                                                    @foreach($roles as $role)
                                                        @if($role->name=="utilisateur")
                                                            <option  value="{{$role->id}}">
                                                                    {{$role->display_name}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                 @endif

                                                @if(Auth::user()->getUserRole()->name=='superadmin')
                                                    @foreach($roles as $role)
                                                            <option  value="{{$role->id}}">
                                                                {{$role->display_name}}
                                                            </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @if ($errors->has('role_id'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('role_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if(Auth::user()->role->hasPermission('add-permission'))
                                            <a class="btn btn-danger"  id="addroleonformcreate" title="Ajouter un rôle">
                                                <i class="fa fa-plus-square"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="item form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group{{ $errors->has('isactif') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isactif">Activer le compte
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="checkbox" value="1" id="isactif" name="isactif" class="js-switch">
                                            @if ($errors->has('isactif'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('isactif') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group" {{ $errors->has('photo') ? ' has-error' : '' }}>
                                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Photo*</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file"   name="photo" >
                                            @if ($errors->has('photo'))
                                                <span class="help-block">
                                                     <strong>{{ $errors->first('photo') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="item form-group{{ $errors->has('password') ? ' has-error' : '' }} ">
                                        <label for="password" class="control-label col-md-3">Mot de passe</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password" type="password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                                        <label for="password-confirm" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmation mot de passe</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            @if ($errors->has('password-confirm'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('password-confirm') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <a  href="javascript:history.back()"  class="btn btn-primary"><i class="fa fa-ban" aria-hidden="true"></i>Annuler</a>
                                            <button class="btn btn-success" type="submit">
                                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                                Enrégistrer
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fenetre modal role-->
    <div class="modal  fade" tabindex="-1" role="dialog" id="add-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">*</button>
                    <h5 id="myModalLabel">Ajouter un rôle</h5>
                </div>
                <form class="form-horizontal" >
                    <div class="modal-body">
                        <div class="error_add "></div>
                        <div id="error_role_add_name" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nom*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control name" name="name">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="error_role_add_display_name" class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nom à afficher</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control display_name" name="display_name">
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
                                <textarea   class="form-control col-md-7 col-xs-12 description " name="description"></textarea>
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
                                <button type="button" id="role_add_save" class="btn btn-success"  aria-hidden="true">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Enrégistrer
                                </button>
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
    <script src="{{asset('immobilier/role/add.js')}}"></script>
@endsection