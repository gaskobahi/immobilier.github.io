@extends('layouts.backend.base')
@section('title')
    Modification de titre de propriété
@endsection
@section('content')

    <div class="row">
        <div  class=" col-md-12 col-sm-12 col-xs-12" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>TITRE DE PROPRIETE</h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Modification titre de propriété  <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('titrepropriete.update',$titrepropriete->id)}}" enctype="multipart/form-data" novalidate>
                                {{ csrf_field() }}
                                <!--<span class="section">Information personnel</span> -->
                                    <div  class="item form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Libéllé <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="name" value="{{$titrepropriete->name}}" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nom" required="required" type="text">
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
                                                @foreach($proprietaires as $proprietaire)
                                                    <option
                                                            @if($proprietaire->id==$titrepropriete->proprietaire_id)
                                                            selected="selected "
                                                            @endif value="{{$proprietaire->id}}">
                                                        {{$proprietaire->name." ".$proprietaire->surname." / ".$proprietaire->phone1}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('proprietaire_id'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('proprietaire_id')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div  class="item form-group{{ $errors->has('piece') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="piece">Pièce jointe <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file"  value="{{asset('uploads/piecetitrepropriete/'.$titrepropriete->piece )}}"  name="piece" >
                                            @if ($errors->has('piece'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('piece')}}</strong>
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