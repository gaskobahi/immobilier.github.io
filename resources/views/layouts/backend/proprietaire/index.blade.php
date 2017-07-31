@extends('layouts.backend.base')
@section('title')
    Type annonces
@endsection
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Propriétaire
                    @if(Auth::user()->role->hasPermission('add-proprietaire'))
                        <a class="btn btn-primary" href="{{route('proprietaire.create')}}">
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
                            <th class="column-title">Prénom(s)</th>
                            <th class="column-title">Sexe</th>
                            <th class="column-title">Ville</th>
                            <th class="column-title">Téléphone1</th>
                            <th class="column-title">Téléphone2</th>
                            <th class="column-title">Crée le) </th>
                            <th class="column-title">Modifié le </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($proprietaires as $proprietaire)
                            <tr class="even pointer">
                                <td class=" ">{{$proprietaire->id}}</td>
                                <td class=" ">{{$proprietaire->name}}</td>
                                <td class=" ">{{$proprietaire->surname}}</td>
                                <td class=" ">
                                    {{$proprietaire->getProprietaireSexe()}}
                                </td>
                                <td class=" ">{{$proprietaire->ville->name}}</td>
                                <td class=" ">{{$proprietaire->phone1}}</td>
                                <td class=" ">{{$proprietaire->phone2}}</td>
                                <td class=" ">{{$proprietaire->created_at}}</td>
                                <td class=" ">{{$proprietaire->updated_at}}</td>
                                <td class=" last">
                                    @if(Auth::user()->role->hasPermission('edit-proprietaire'))
                                    <a href="{{route('proprietaire.edit',$proprietaire->id)}}"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(Auth::user()->role->hasPermission('delete-proprietaire'))
                                        <a href="{{route('user.delete',$proprietaire->id)}}"><i class="fa fa-trash-o"></i></a>
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
@endsection