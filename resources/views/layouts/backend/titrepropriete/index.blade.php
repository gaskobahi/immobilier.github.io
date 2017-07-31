@extends('layouts.backend.base')
@section('title')
    Titre Propriétés
@endsection
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Titre de propriété
                    @if(Auth::user()->role->hasPermission('add-titrepropriete'))
                    <a class="btn btn-primary" href="{{route('titrepropriete.create')}}">
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
                            <th class="column-title">Proprietaire</th>
                            <th class="column-title">Crée le) </th>
                            <th class="column-title">Modifié le </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>

                        </tr>
                        </thead>

                        <tbody>

                        @foreach($titreproprietes as $titrepropriete)
                            <tr class="even pointer">
                                <td class=" ">{{$titrepropriete->id}}</td>
                                <td class=" ">{{$titrepropriete->name}}</td>
                                <td class=" ">{{$titrepropriete->proprietaire->name.' '.
                                $titrepropriete->proprietaire->surname.' / '.
                                $titrepropriete->proprietaire->phone1}}
                                </td>
                                <td class=" ">{{$titrepropriete->created_at}}</td>
                                <td class=" ">{{$titrepropriete->updated_at}}</td>
                                <td class=" last">
                                    @if(Auth::user()->role->hasPermission('edit-titrepropriete'))
                                    <a href="{{route('titrepropriete.edit',$titrepropriete->id)}}"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(Auth::user()->role->hasPermission('delete-titrepropriete'))
                                    <a href="{{route('user.delete',$titrepropriete->id)}}"><i class="fa fa-trash-o"></i></a>
                                    @endif
                                    <a href="{{route('titrepropriete.getpdf',$titrepropriete->id)}}"><i class="fa fa-file-pdf-o"></i></a>
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
