@extends('layouts.backend.base')
@section('title')
    Liste des annonces
@endsection
@section('styles')
    <link href="{{asset('gentelella/vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet"
          xmlns="http://www.w3.org/1999/html">
    <link href="{{asset('immobilier/annonce/css/stylesannonce.css')}}">
@endsection
@section('content')

    <script>
        var  token='{{Session::token()}}';
        var  tok='{{Session::token()}}';
        var urldetail='{{route('annonce.detailajax')}}';
        var urlupdatestatutannonce='{{route('annonce.updatestatutannonce')}}';
        var urlexpirestatutannonce='{{route('annonce.updateexpireannonce')}}';
    </script>

    <div class="">
        <div class="ol-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bars"></i>  <small>ANNONCES &nbsp; </small></h2>
                    <a class="btn btn-primary" href="{{route('annonce.create')}}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Ajouter
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    @include('flash')
                </div>
                <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Toutes les annonces <span><i>({{$totalannonce}})</i></span></a>
                            </li>
                        </ul>


                        <div id="myTabContent" class="tab-content">

                            <div  role="tabpanel" class=" col-md-12 col-sm-12 col-xs-12 tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                @foreach($annonces as $annonce)
                                    <div class="row ">
                                        <div class="col-sm-4">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;"
                                                         @foreach($annonce->photos as $photo)src="{{asset('uploads/photos/'.$photo->name)}}" @endforeach  alt="" />
                                                    <div class="mask">
                                                        <p>{{$annonce->typeannonce->name}}</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i> {{count($annonce->photos)}}</i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p align="center">{{$annonce->categorie->name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 style="color: #00A000">{{$annonce->titre}}</h2>
                                            <h2 style="color:#942a25">{{$annonce->getAnnonceCategorieSuperficeorNombrepiece()}}</h2>
                                            <h3 style="color: #000000">{{$annonce->getAnnoncePrix()}}</h3>


                                            <h4>{{$annonce->ville->name}} </h4>
                                            <a class="btn btn-info" title="Voir les détails" href="{{route('annonce.detail',$annonce->id)}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Voir le détails</a>
                                            <p> Créée le :<i>{{$annonce->created_at}} </i></p>
                                            <p> Modifiée le :<i>{{$annonce->updated_at}} </i></p>
                                    <!------------------ btn edit annonce----------------------------------->
                                            @if(Auth::user()->hasRole('utilisateur'))
                                                @if(Auth::user()->id==$annonce->user_id &&$annonce->status==0)
                                                    @if(Auth::user()->role->hasPermission('edit-annonce'))
                                                    <a class="btn btn-success" href="{{route('annonce.edit',$annonce->id)}}" title="Modifier"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    @endif
                                                @endif
                                            @endif

                                            @if(Auth::user()->hasRole('admin'))
                                                @if(Auth::user()->id==$annonce->user_id &&$annonce->status==0)
                                                    @if(Auth::user()->role->hasPermission('edit-annonce'))
                                                        <a class="btn btn-success" href="{{route('annonce.edit',$annonce->id)}}" title="Modifier"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    @endif
                                                @endif
                                            @endif

                                            @if(Auth::user()->hasRole('superadmin'))
                                                @if(Auth::user()->id==$annonce->user_id &&$annonce->status==0)
                                                    @if(Auth::user()->role->hasPermission('edit-annonce'))
                                                        <a class="btn btn-success" href="{{route('annonce.edit',$annonce->id)}}" title="Modifier"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    @endif
                                                @endif
                                            @endif

                                        <!-- ----------------------------btn--delete annnonce-------------------------------------->
                                            @if(Auth::user()->hasRole('superadmin'))
                                                @if($annonce->status==0 && $annonce->expire==1)
                                                        @if(Auth::user()->role->hasPermission('delete-annonce'))
                                                            <a class="btn btn-danger" href="{{route('annonce.delete',$annonce->id)}}" title="Supprimer"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                        @endif
                                                @endif
                                            @endif

                                            @if(Auth::user()->hasRole('admin'))
                                                @if(Auth::user()->id==$annonce->user_id|| $annonce->getRoleNameOfUserAnnonce()=='utilisateur')
                                                     @if($annonce->status==0 && $annonce->expire==1)
                                                        @if(Auth::user()->role->hasPermission('delete-annonce'))
                                                            <a class="btn btn-danger" href="{{route('annonce.delete',$annonce->id)}}" title="Supprimer"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif

                                            @if(Auth::user()->hasRole('utilisateur'))
                                                @if(Auth::user()->id==$annonce->user_id)
                                                    @if($annonce->status==0 && $annonce->expire==1)
                                                        @if(Auth::user()->role->hasPermission('delete-annonce'))
                                                            <a class="btn btn-danger" href="{{route('annonce.delete',$annonce->id)}}" title="Supprimer"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            <!-- end delete annonce-->
                                        </div>
                                        <div class="col-sm-4">
                                                <p>
                                                    Statut :<i class="btn-success statutpublicationannonce_{{$annonce->id}}">{{$annonce->getstatus()}} </i>|
                                                     Etat :<i class="btn-danger etatpublicationannonce_{{$annonce->id}}">{{$annonce->getexpire()}} </i>
                                                </p>
                                                <p> Titre de propriété : <strong> {{$annonce->titrepropriete->name}}</strong></p>
                                                <p> Propriété de : <strong > {{$annonce->titrepropriete->proprietaire->name.' '. $annonce->titrepropriete->proprietaire->surname}}</strong></p>
                                                <p>Enrégistrée par :<i> {{$annonce->user->pseudo}}</i></p>
                                            @if(Auth::user()->role->hasPermission('status-annonce'))
                                            <p>
                                                 <strong>Publier l'annonce</strong>
                                                 <input type="checkbox" @if($annonce->status==1) checked="checked" @endif onchange="getanonceid({{$annonce->id}})" class="js-switch btnannoncepublier_{{$annonce->id}}">
                                              </p>
                                            @endif
                                            <p>Le statut modifié par :<i class="updatedstatusby_publicationannonce_{{$annonce->id}}"> {{$annonce->updatedstatus_by}}</i></p>
                                            @if($annonce->status==1)
                                            <p><i class="datestatutpublicationannonce_{{$annonce->id}}"> {{$annonce->getDateOfAnnonce().' par '.$annonce->updatedstatus_by}}</i></p>
                                            @endif


                                        @if(Auth::user()->role->hasPermission('expire-annonce'))
                                            <p>
                                                    <strong>Retirer l'annonce</strong>
                                                    <input type="checkbox"  @if($annonce->expire==1) checked="checked" @endif onchange="getanoncevalid({{$annonce->id}})" class="js-switch btnannonceretirer_{{$annonce->id}} "/>
                                             </p>
                                            @endif
                                                <p>L'état modifié  par :<i class="updatedexpireby_publicationannonce_{{$annonce->id}}"> {{$annonce->updatedstatus_by}}</i></p>
                                            <p>
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        <hr />
                                    @endif
                                @endforeach
                                {{$link}}
                            </div>
                         </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{asset('immobilier/annonce/js/annonce.js')}}"></script>
    <script src="{{asset('immobilier/annonce/js/publierannonce.js')}}"></script>
    <script src="{{asset('immobilier/annonce/js/expireannonce.js')}}"></script>

@endsection

