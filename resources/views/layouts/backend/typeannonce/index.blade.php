@extends('layouts.backend.base')
@section('title')
    Type annonces
@endsection
@section('content')
    <script>
        var  token='{{Session::token()}}';
        url='{{route('typeannonce.destroy')}}';
    </script>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Type Annonces
                    @if(Auth::user()->role->hasPermission('add-typeannonce'))
                    <a class="btn btn-primary" href="{{route('typeannonce.create')}}">
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
                            <th class="column-title">Crée le) </th>
                            <th class="column-title">Modifié le </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>

                        </tr>
                        </thead>

                        <tbody>

                        @foreach($typeannonces as $typeannonce)
                            <tr class="tpannonce_{{$typeannonce->id}}" class="even pointer">
                                <td class="tpaid_{{$typeannonce->id}}">{{$typeannonce->id}}</td>
                                <td class="tpaname_{{$typeannonce->id}} ">{{$typeannonce->name}}</td>
                                <td class="tpacreated_{{$typeannonce->id}} ">{{$typeannonce->created_at}}</td>
                                <td class="tpaupdated_{{$typeannonce->id}} ">{{$typeannonce->updated_at}}</td>
                                <td  class="last">
                                    @if(Auth::user()->role->hasPermission('edit-typeannonce'))
                                    <a class="a_typeannonce_edit_{{$typeannonce->id}}"   href="{{route('typeannonce.edit',$typeannonce->id)}}"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(Auth::user()->role->hasPermission('delete-typeannonce'))
                                    <a class="a_typeannonce_delete_{{$typeannonce->id}}" onclick="getdeletetypeannonceid({{$typeannonce->id}})"   href="#"><i class="fa fa-trash-o"></i></a>
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
@section('script')
<script src="{{asset('immobilier/typeannonce/deleterow.js')}}"></script>
@endsection