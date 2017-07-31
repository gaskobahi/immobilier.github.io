@extends('layouts.backend.base')
@section('title')
    Creation de ville
@endsection
@section('content')

    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>VILLE</h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Creation ville  <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('ville.store')}}" novalidate>
                                {{ csrf_field() }}
                                <!--<span class="section">Information personnel</span> -->
                                    <div  class="item form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Commune <span class="required">*</span>
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
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ville<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="ville_id" name="ville_id" class="form-control">
                                                <option  selected="selected ">Choisir la ville</option>
                                                @foreach($villes as $v2)
                                                    <option value="{{$v2->id}}">
                                                    {{$v2->name}}
                                                     </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div  class="item form-group{{ $errors->has('longitude') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longitude">Longitude <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="longitude" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="longitude" placeholder="Longitude" required="required" type="text">
                                            @if ($errors->has('longitude'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('longitude')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div  class="item form-group{{ $errors->has('latitude') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitude">Lattitude <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="latitude" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="latitude" placeholder="Latitude" required="required" type="text">
                                            @if ($errors->has('latitude'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('latitude')}}</strong>
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