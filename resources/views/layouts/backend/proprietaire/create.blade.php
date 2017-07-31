@extends('layouts.backend.base')
@section('title')
    Creation propriétaire
@endsection
@section('content')

    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>PROPRIETAIRE</h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Creation propriétaire  <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('proprietaire.store')}}" novalidate>
                                {{ csrf_field() }}
                                    <div  class="item form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nom" required="required" type="text">
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
                                            <input id="surname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="surname" placeholder="Prénom(s)" required="required" type="text">
                                            @if ($errors->has('surname'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('surname')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Genre
                                            <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="sexe" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" checked="checked" name="sexe" value="m"> &nbsp; Masculin &nbsp;
                                                </label>
                                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="sexe" value="f"> Feminin
                                                </label>
                                            </div>
                                            @if ($errors->has('sexe'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('sexe') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div  class="item form-group{{ $errors->has('phone1') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone1">Téléphone1 <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="phone1" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="phone1" placeholder="Téléphone1" required="required" type="text">
                                            @if ($errors->has('phone1'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('phone1')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div  class="item form-group{{ $errors->has('phone2') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone2">Téléphone2<span class="required"></span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="phone2" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="phone2" placeholder="Téléphone2" value="{{old('phone2','')}}" type="text">
                                            @if ($errors->has('phone2'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('phone2')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group{{ $errors->has('ville_id') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Lieu d'habitation<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="ville_id" name="ville_id" class="form-control">
                                                <option value="">Choisir la ville </option>
                                                @foreach($villes as $ville)
                                                    <option value="{{$ville->id}}">
                                                    {{$ville->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('ville_id'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('ville_id')}}</strong>
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
@endsection
