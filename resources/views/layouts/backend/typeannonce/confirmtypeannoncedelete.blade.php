@extends('layouts.backend.base')
@section('title')
    Confirmation de suppression Typeannonce
@endsection
@section('content')

    <div class="">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Confirmation de la suppression </h2>
                    <div  class="clearfix"></div>
                </div>
                <div class="x_content">

                    <h2 align="center">Etes vous sûr de vouloir supprimer <strong data-bgColor="red">{{$typeannonce->name}}</strong>?</h2><br/>
                    <!-- start pop-over -->
                    <div  align="center" class="bs-example-popovers">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('typeannonce.confirmtypeannoncedelete',$typeannonce->id) }}" novalidate>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <a  href="javascript:history.back()"  class="btn btn-primary">
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                        Annuler
                                    </a>
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                        Confirmer
                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- end pop-over -->
                </div>
            </div>
        </div>
    </div>
@section('script')
    <!-- Parsley -->
    <script src="{{asset('gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
@endsection

@endsection