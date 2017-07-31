@extends('layouts.backend.base')
@section('title')
    Créer une annonce
@endsection
@section('styles')
    <link href="{{asset('gentelella/vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
@endsection
@section('content')

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
                                <h2>Modification d'annonce <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" role="form" method="POST" action="{{route('annonce.update',$annonce->id)}}"  enctype="multipart/form-data" novalidate>
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
                                                    <input  value="{{$annonce->titre}}" type="text" id="titre"  name="titre"  class="form-control col-md-7 col-xs-12">
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
                                                        @foreach($categories as $category)
                                                            <option @if($category->id==$annonce->categorie_id) selected="selected" @endif value="{{$category->id}}">
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
                                            </div>
                                            <div class="item form-group{{ $errors->has('typeannonce_id') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type Annonce<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="categorie_id" name="typeannonce_id" class="form-control">
                                                        @foreach($typeannonces as $typeannonce)
                                                            <option @if($typeannonce->id==$annonce->typeannonce_id) selected="selected" @endif value="{{$typeannonce->id}}">
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
                                            </div>
                                            <div class="item form-group{{ $errors->has('ville_id') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Quartier<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="ville_id" name="ville_id" class="form-control">
                                                        @foreach($villes as $ville)
                                                            <option @if($ville->id==$annonce->ville_id) selected="selected" @endif value="{{$ville->id}}">
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
                                                    <textarea id="description" required="required" class="form-control col-md-7 col-xs-12" name="description">{{$annonce->description}}</textarea>
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
                                                    <select id="titrepropriete_id"  name="titrepropriete_id" class="form-control">
                                                        @foreach($titreproprietes as $titrepropriete)
                                                            <option @if($titrepropriete->id==$annonce->titrpropriete_id) selected="selected" @endif value="{{$titrepropriete->id}}">
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
                                            </div>
                                            <div class="item form-group{{ $errors->has('nombrepiece') ? ' has-error' : '' }}">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de pièce<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="nombrepiece"   name="nombrepiece" class="form-control">
                                                        @for($i=1;$i<=40;$i++)
                                                            <option @if($i==$annonce->nombrepiece)selected="selected" @endif value=" {{$i}}">{{$i}}</option>
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
                                                        @for($i=200;$i<=10000;$i+=50)
                                                            <option @if($i==$annonce->superficie)selected="selected" @endif value="{{$i}}">{{$i}}</option>
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
                                                    <input type="text" value="{{$annonce->prix}}" id="prix"  name="prix"  class="form-control col-md-7 col-xs-12">
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
                                            <script>
                                                var urldetail='{{route('annonce.removephoto')}}';
                                            </script>

                                            <div class="row">
                                                @foreach($annonce->photos as $photo)
                                                <div class="diveditannoncephoto_{{$photo->id}} col-md-55">
                                                    <div class="thumbnail">
                                                        <div class="image view view-first">
                                                            <img  class="imgeditannoncephoto " style="width: 100%; display: block;" src="{{asset('uploads/photos/'.$photo->name)}}" />
                                                            <div class="mask">
                                                                <div class="tools tools-bottom">
                                                                    <a class="diveditannoncephotoremove_{{$photo->id}} label label-danger" onclick="getIdImgToRemove({{$photo->id}})" href="#"><i class="fa fa-trash-o"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                                <div class="form-group" {{ $errors->has('photos') ? ' has-error' : '' }}>
                                                <label for="photos" class="control-label col-md-3 col-sm-3 col-xs-12">Photo*</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="file"  value="{{asset('uploads/users/'.$annonce->photos )}}"  name="photos[]" multiple>
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


@endsection
@section('script')
    <script src="{{asset('gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}" ></script>
    <script src="{{asset('gentelella/vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{asset('immobilier/annonce/js/editremovephoto.js')}}"></script>

@endsection