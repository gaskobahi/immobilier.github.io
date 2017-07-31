@extends('layouts.backend.base')
@section('title')
    Modification utilisateur
@endsection
@section('content')

    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Changer mon mot de passe </h3>
                    </div>
                    <div class="title_left">
                        @include('flash')
                    </div>


                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('user.updatepasswordpost') }}" novalidate>
                                    {{ csrf_field() }}
                                    <!--<span class="section">Information personnel</span> -->
                                        <div class="item form-group{{ $errors->has('lastpasswd') ? ' has-error' : '' }} ">
                                            <label  class="control-label col-md-3"></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="lastpasswd"  type="hidden" value="{{$lastpasswd}}" class="form-control" name="lastpasswd">
                                            </div>
                                        </div>
                                        <div class="item form-group{{ $errors->has('lastpassword') ? ' has-error' : '' }} ">
                                            <label for="password" class="control-label col-md-3">Ancien Mot de passe</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="lastpassword" type="password" class="form-control" name="lastpassword" required>
                                                @if ($errors->has('lastpassword'))
                                                    <span class="help-block">
                                                 <strong>{{ $errors->first('lastpassword') }}</strong>
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
@section('script')
    <!-- Parsley -->
    <script src="{{asset('gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
@endsection

@endsection