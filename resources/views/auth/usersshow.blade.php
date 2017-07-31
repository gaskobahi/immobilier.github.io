@extends('layouts.backend.base')
@section('title')
   Utilisateurs
@endsection
@section('styles')
    <link href="{{asset('css/listnav.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Utilisateurs
                    <a class="btn btn-primary" href="{{url('/register')}}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Ajouter
                    </a>
                </h3>

            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Aller</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                @include('flash')
                            </div>

                            <div class="clearfix"></div>
                            @foreach($users as $user)
                                <div  class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                        <div class="col-sm-12">
                                            <h4 class=" brief"><i>{{$user->name .' '.$user->surname }} </i></h4>
                                            <div class="left col-xs-7">
                                                <h2 style="color: red;">
                                                    {{$user->getUserRole()->display_name}}
                                                </h2>
                                                <p><strong>Statut: </strong>
                                                        <label style="color: blue;">
                                                            {{$user->getUserIsactif()}}
                                                        </label>
                                                    </p>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-building"></i> Email: {{$user->email}}</li>
                                                    <li><i class="fa fa-user"></i> Sexe :
                                                        {{$user->getUserSexe()}}
                                                       </li>
                                                </ul>
                                            </div>
                                            <div class="right col-xs-5 text-center">
                                                {{--@if(Empty($user->photo))
                                                    <img src="{{asset('uploads/users/avatar.jpg')}}"  class="img img-circle" alt="" width="70px" height="70px">
                                                @else
                                                    <img src="{{asset('uploads/users/'.$user->photo)}}" class="img img-circle" alt="" width="70px" height="70px">
                                                @endif--}}
                                                    <img src="{{asset($user->getPhotoPath())}}"  class="img img-circle" alt="" width="70px" height="70px">


                                            </div>
                                        </div>
                                        <div class="col-xs-12 bottom text-center">
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <p class="ratings">
                                                    @if(Auth::user()->hasRole('superadmin'))
                                                        @if(Auth::user()->role->hasPermission('edit-user'))
                                                            <a   href="{{route('user.edit',$user->id)}}"   title="Modifier l'utilisateur"class="btn btn-success btn-xs"> <i class="fa fa-user">
                                                            </i> <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endif

                                                        @if(Auth::user()->role->hasPermission('delete-user'))
                                                            <a href="{{route('user.delete',$user->id)}}" title="Suprimer l'utilisateur" class="btn btn-danger btn-xs"> <i class="fa fa-user">
                                                                </i> <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        @endif
                                                    @endif

                                                     @if(Auth::user()->hasRole('admin'))
                                                            @if($user->hasRole('utilisateur'))
                                                                @if(Auth::user()->role->hasPermission('edit-user'))
                                                                    <a   href="{{route('user.edit',$user->id)}}"   title="Modifier l'utilisateur"class="btn btn-success btn-xs"> <i class="fa fa-user">
                                                                        </i> <i class="fa fa-edit"></i>
                                                                    </a>
                                                                @endif

                                                                @if(Auth::user()->role->hasPermission('delete-user'))
                                                                    <a href="{{route('user.delete',$user->id)}}" title="Suprimer l'utilisateur" class="btn btn-danger btn-xs"> <i class="fa fa-user">
                                                                        </i> <i class="fa fa-trash-o"></i>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                      @endif
                                                </p>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <a href="#" type="button"  class="btn btn-primary btn-xs">
                                                    <i class="fa fa-user"> </i> Voir le détail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {!!$link!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/jquery-listnav.js')}}" ></script>
    <script>

    </script>
@endsection