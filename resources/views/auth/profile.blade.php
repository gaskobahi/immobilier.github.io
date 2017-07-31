@extends('layouts.backend.base')
@section('title')
   Profile  utilisateur
@endsection
@section('content')

    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">
                <div class="page-title">

                    <div class="title_left">
                        <h3>Mon Profil</h3>
                    </div>
                    <div class="title_left">
                        @include('flash')
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Information personnel <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div  class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><strong>Nom</strong> <span class="required">:</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class=" col-md-7 col-xs-12">{{$user->name}}
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div  class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><strong>Prénom(s)</strong> <span class="required">:</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class=" col-md-7 col-xs-12">{{$user->surname}}
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div  class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><strong>Email</strong> <span class="required">:</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class=" col-md-7 col-xs-12">{{$user->email}}
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div  class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><strong>Pseudonyme</strong> <span class="required">:</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class=" col-md-7 col-xs-12">{{$user->pseudo}}
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div  class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><strong>Rôle </strong><span class="required">:</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class=" col-md-7 col-xs-12">
                                           {{$user->getUserRole()->display_name}}
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div  class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><strong>Crée le</strong> <span class="required">:</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class=" col-md-7 col-xs-12">
                                           {{$user->created_at}}
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div  class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><strong>Modifié le</strong> <span class="required">:</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class=" col-md-7 col-xs-12">
                                           {{$user->updated_at}}
                                        </label>
                                    </div>
                                </div>
                                <div  class="item form-group">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" novalidate>
                                        {{ csrf_field() }}
                                        <!--<span class="section">Information personnel</span> -->
                                        <div class="ln_solid"></div>

                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <a id="send" href="{{route("user.updatepassword",$user->id)}}" class="btn btn-danger">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    Changer mon mot de passe
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
