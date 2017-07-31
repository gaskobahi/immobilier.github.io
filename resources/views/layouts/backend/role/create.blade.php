@extends('layouts.backend.base')
@section('title')
    Créer un rôle
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
                        <h3>ROLE</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Creation de rôle <small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('role.store')}}" novalidate>
                                {{ csrf_field() }}
                                <!--<span class="section">Information personnel</span> -->
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
                                    <div  class="item form-group{{ $errors->has('display_name') ? ' has-error' : '' }} ">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="display_name">Nom à afficher <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="display_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="display_name" placeholder="Nom à afficher" required="required" type="text">
                                            @if ($errors->has('display_name'))
                                                <span class="help-block">
                                                 <strong>{{ $errors->first('display_name')}}</strong>
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
@section('script')
    <script src="{{asset('gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}" ></script>
    <script src="{{asset('gentelella/vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
@endsection