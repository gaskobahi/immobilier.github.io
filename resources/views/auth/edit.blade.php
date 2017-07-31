@extends('layouts.backend.base')
@section('title')
    Modification utilisateur
@endsection
@section('content')
    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Modification utilisateur <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data"  novalidate>
                                    {{ csrf_field() }}
                                    <span class="section">Information personnel</span>

                                    <div  class="item form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="name"  class="form-control col-md-7 col-xs-12" value="{{$user->name}}" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nom" required="required" type="text">
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
                                            <input id="surname" class="form-control col-md-7 col-xs-12"  value="{{$user->surname}}" data-validate-length-range="6" data-validate-words="2" name="surname" placeholder="Prénom(s)" required="required" type="text">
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
                                            <input id="pseudo" class="form-control col-md-7 col-xs-12"   value="{{$user->pseudo}}" data-validate-length-range="6" data-validate-words="2" name="pseudo" placeholder="Pseudonyme" required="required" type="text">
                                            @if ($errors->has('pseudo'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('pseudo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email"   value="{{$user->email}}" required="required" class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="item form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">

                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Genre
                                            <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="sex" class="btn-group" data-toggle="buttons">
                                                <label @if($user->sexe=='m')class="btn btn-danger"@else class="btn btn-default"@endif data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" @if($user->sexe=='m') checked="checked" @endif checked="checked" name="sexe" value="m"> &nbsp; Masculin &nbsp;
                                                </label>
                                                <label @if($user->sexe=='f')class="btn btn-danger"@else class="btn btn-default"@endif data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="sexe" @if($user->sexe=='f') checked="checked" @endif value="f"> Feminin
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

                                                    @if(Auth::user()->getUserRole()->name=='admin')
                                                        @foreach($roles as $role)
                                                            @if($role->name=="utilisateur")
                                                                <option
                                                                        @if($role->id==$user->role_id)
                                                                        selected="selected "
                                                                        @endif
                                                                        value="{{$role->id}}">
                                                                    {{$role->display_name}}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if(Auth::user()->getUserRole()->name=='superadmin')
                                                        @foreach($roles as $role)
                                                            <option
                                                                    @if($role->id==$user->role_id)
                                                                    selected="selected "
                                                                    @endif
                                                                    value="{{$role->id}}">
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
                                    </div>
                                    <div class="item form-group{{ $errors->has('isactif') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isactif">Activer le compte
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <div id="cptactif" class="btn-group" data-toggle="buttons">
                                                <label @if($user->isactif==0)class="btn btn-danger"@else class="btn btn-default"@endif data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" @if($user->isactif==0) checked="checked" @endif checked="checked" name="isactif" value="0"> &nbsp; Désactivé &nbsp;
                                                </label>
                                                <label @if($user->isactif==1)class="btn btn-danger"@else class="btn btn-default"@endif data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="isactif" @if($user->isactif==1) checked="checked" @endif value="1"> Activé
                                                </label>
                                            </div>


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
                                            <input type="file"  value="{{asset('uploads/users/'.$user->photo )}}"  name="photo" >
                                            @if ($errors->has('photo'))
                                                <span class="help-block">
                                                     <strong>{{ $errors->first('photo') }}</strong>
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
@section('script')
    <!-- Parsley -->
    <script src="{{asset('gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
@endsection

@endsection