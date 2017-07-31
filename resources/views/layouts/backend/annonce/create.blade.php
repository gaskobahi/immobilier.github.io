@extends('layouts.backend.base')
@section('title')
    Créer une annonce
@endsection
@section('styles')
        <link href="{{asset('gentelella/vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <script>
        var roleid=0,namer="",displeditname,roleeditdescrip,errorform,errnam=[],nametitreprop,pieceann,proprietaireann;
        //appel du formulaire modal ansi que les infos affivher daans le table
        var  token='<?php echo e(Session::token()); ?>';
        var urlcat='<?php echo (route('categorie.categorieaddajax')); ?>';
        var urltitrepropriete='<?php echo (route('TitreproprieteController.titreproprieteaddajax')); ?>';
        var urltpannonce='<?php echo (route('TypeannonceController.typeannonceaddajax')); ?>';
        var urltproprietaire='<?php echo (route('ProprietaireController.proprietaireaddajax')); ?>';
    </script>

    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>ANNONCE</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Creation d'annonce <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('annonce.upload') }}"  enctype="multipart/form-data" novalidate>
                                    {{ csrf_field() }}
                                    <div id="wizard" class="form_wizard wizard_horizontal">
                                    <ul class="wizard_steps">
                                        <li>
                                            <a href="#step-1">
                                                <span class="step_no">1</span>
                                                <span class="step_descr">
                                             Etape 1<br />
                                              <small>Etape 1 Générale</small>
                                          </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-2">
                                                <span class="step_no">2</span>
                                                <span class="step_descr">
                                              Etape 2<br />
                                              <small>Etape 2 Spécifique</small>
                                          </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-3">
                                                <span class="step_no">3</span>
                                                <span class="step_descr">
                                              Etape 3<br />
                                              <small>Etape 3 Photos</small>
                                          </span>
                                            </a>
                                        </li>

                                    </ul>

                                    <div id="step-1">
                                            <div class="form-group{{ $errors->has('titre') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titre">Titre <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="titre"  name="titre"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                                @if ($errors->has('titre'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('titre') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="item form-group{{ $errors->has('categorie_id') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Catégorie<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="categorie_id" name="categorie_id" class="form-control">
                                                        <option value="" selected="selected">Choisir le Catégorie</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">
                                                                {{$category->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('categorie_id'))
                                                        <span class="help-block">
                                                             <strong>{{ $errors->first('categorie_id') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>
                                                @if(Auth::user()->role->hasPermission('add-permission'))
                                                    <a class="btn btn-danger"  id="addcategorieonformcreate" title="Ajouter une catégorie">
                                                        <i class="fa fa-plus-square"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="item form-group{{ $errors->has('typeannonce_id') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type Annonce<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="typeannonce_id" name="typeannonce_id" class="form-control">
                                                        <option value="" selected="selected">Choisir le type Annonce</option>
                                                        @foreach($typeannonces as $typeannonce)
                                                            <option value="{{$typeannonce->id}}">
                                                                {{$typeannonce->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('typeannonce_id'))
                                                        <span class="help-block">
                                                 <strong>{{ $errors->first('typeannonce_id') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                                @if(Auth::user()->role->hasPermission('add-permission'))
                                                    <a class="btn btn-danger"  id="addtypeannonceformcreate" title="Ajouter un type annonce">
                                                        <i class="fa fa-plus-square"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="item form-group{{ $errors->has('ville_id') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Quartier<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="ville_id" name="ville_id" class="form-control">
                                                        <option value="" selected="selected">Choisir le quartier</option>
                                                        @foreach($villes as $ville)
                                                            <option value="{{$ville->id}}">
                                                                {{$ville->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('ville_id'))
                                                        <span class="help-block">
                                                 <strong>{{ $errors->first('ville_id') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea id="description" required="required" class="form-control col-md-7 col-xs-12" name="description"></textarea>
                                                </div>
                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                    </div>
                                    <div id="step-2">
                                        <div class="item form-group{{ $errors->has('titrepropriete_id') ? ' has-error' : '' }}">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Titre de propriété<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="titrepropriete_id" name="titrepropriete_id" class="form-control">
                                                    <option value="" selected="selected">Choisir le titre de propriété</option>
                                                    @foreach($titreproprietes as $titrepropriete)
                                                        <option value="{{$titrepropriete->id}}">
                                                            {{$titrepropriete->name.' '.
                                                            $titrepropriete->proprietaire->name.' '.
                                                            $titrepropriete->proprietaire->surname.' / '.
                                                            $titrepropriete->proprietaire->phone1}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('titrepropriete_id'))
                                                    <span class="help-block">
                                                 <strong>{{ $errors->first('titrepropriete_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            @if(Auth::user()->role->hasPermission('add-permission'))
                                                <a class="btn btn-danger"  id="addtitreproprieteformcreate" title="Ajouter une catégorie">
                                                    <i class="fa fa-plus-square"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="item form-group{{ $errors->has('nombrepiece') ? ' has-error' : '' }}">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de pièce<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="nombrepiece" name="nombrepiece" class="form-control">
                                                    <option value="" selected="selected">Choisir le nombre de pièce</option>
                                                    @for($i=1;$i<=40;$i++)
                                                        <option  value=" {{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                                @if ($errors->has('nombrepiece'))
                                                    <span class="help-block">
                                                 <strong>{{ $errors->first('nombrepiece') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group{{ $errors->has('superficie') ? ' has-error' : '' }}">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Superficie (m2)<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="superficie" name="superficie" class="form-control">
                                                    <option value="" selected="selected">Choisir la superficie</option>
                                                    @for($i=200;$i<=10000;$i+=50)
                                                        <option  value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                                @if ($errors->has('superficie'))
                                                    <span class="help-block">
                                                 <strong>{{ $errors->first('superficie') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('prix') ? ' has-error' : '' }}">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prix">Prix <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="prix"  name="prix"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                            @if ($errors->has('prix'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('prix') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <input type="hidden" id="status"  value="0" name="status"  class="form-control col-md-7 col-xs-12">
                                    </div>
                                    <div id="step-3">

                                        <div class="form-group" {{ $errors->has('photos') ? ' has-error' : '' }}>
                                            <label for="photos" class="control-label col-md-3 col-sm-3 col-xs-12">Photo*</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file"  name="photos[]" multiple>
                                                @if ($errors->has('photos'))
                                                    <span class="help-block">
                                                     <strong>{{ $errors->first('photos') }}</strong>
                                                 </span>
                                                @endif
                                            </div>
                                        </div>

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


    <!-- Fenetre modal categorie-->
<div class="modal  fade" tabindex="-1" role="dialog" id="add-modal-categorie">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">*</button>
                    <h5 id="myModalLabel">Ajouter un catégorie</h5>
                </div>
                <form class="form-horizontal" >
                    <div class="modal-body">
                        <div class="error_add_categorie "></div>
                        <div id="error_categorie_add_name" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
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
                    </div>
                    <div class="modal-footer">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button onclick="emptydatacategorie()" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                                    <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fermer
                                </button>
                                <button type="button" id="categorie_add_save" class="btn btn-success"  aria-hidden="true">
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

    <!-- Fenetre modal type annonce-->
<div class="modal  fade" tabindex="-1" role="dialog" id="add-modal-typeannonce">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">*</button>
                    <h5 id="myModalLabel">Ajouter un type annonce</h5>
                </div>
                <form class="form-horizontal" >
                    <div class="modal-body">
                        <div class="error_add_typeannonce"></div>
                        <div id="error_typeannonce_add_name" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nom*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control nametp" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6 col-md-offset-4">
                            <button onclick="emptydatatpannonce()" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                                <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fermer
                            </button>
                            <button type="button" id="typeannonce_add_save" class="btn btn-success"  aria-hidden="true">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Enrégistrer
                            </button>
                        </div>
                        <div class="form-group"></div>
                    </div>
                    <input type="hidden" name="token" value="{{Session::token()}}">
                </form>
            </div>
        </div>
    </div>

    <!-- Fenetre modal titredepropriete-->
<div class="modal  fade" tabindex="-1" role="dialog" id="add-modal_titrepropriete">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">*</button>
                    <h5 id="myModalLabel">Ajouter un Titre de Propritété</h5>
                </div>
                <form class="form-horizontal form_modal_titrepropriete" >
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="error_add_titrepropriete "></div>
                        <div  class="item form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Code <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12 nametitrpropriete" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Code"  type="text">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="item form-group{{ $errors->has('proprietaire_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Propriétaire<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="proprietaire_id" name="proprietaire_id" class="form-control">
                                    <option   value="" selected="selected ">Choisir le propriétaire</option>
                                    @foreach($proprietaires as $proprietaire)
                                        <option value="{{$proprietaire->id}}">
                                            {{$proprietaire->name." ".$proprietaire->surname." / ".$proprietaire->phone1}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if(Auth::user()->role->hasPermission('add-permission'))
                                <a class="btn btn-danger addproprietaireformcreate"  title="Ajouter un proprietaire">
                                    <i class="fa fa-plus-square"></i>
                                </a>
                            @endif
                        </div>
                        <div  class="item form-group{{ $errors->has('piece') ? ' has-error' : '' }} ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="piece">Pièce jointe <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="piece" type="file"   name="piece" >
                                @if ($errors->has('piece'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('piece')}}</strong>
                                     </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button onclick="emptydatatitreproprieteform()" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                                    <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fermer
                                </button>
                                <button type="submit" id="titrepropriete_add_save" class="btn btn-success"  aria-hidden="true">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Enrégistrer
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.backend.proprietairemodal.propritairemodal')
@endsection
@section('script')
    <script src="{{asset('gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}" ></script>
    <script src="{{asset('gentelella/vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{asset('immobilier/categorie/add.js')}}"></script>
    <script src="{{asset('immobilier/typeannonce/add.js')}}"></script>
    <script src="{{asset('immobilier/titrepropriete/add.js')}}"></script>
    <script src="{{asset('immobilier/proprietaire/add.js')}}"></script>



@endsection