@extends('layouts.backend.base')
@section('title')
    Detail annonce
@endsection
@section('styles')
    <link href="{{asset('gentelella/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
{{--
                <h3>E-commerce :: Product Page</h3>
--}}
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-5 form-group pull-left top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                         <h1><strong>{{$annonce->titre}}</strong></h1>
                        <span>
                             @if($annonce->status==1)
                                    {{$annonce->getDateOfAnnonce().' par '.$annonce->updatedstatus_by}}
                              @endif
                        </span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="product-image">
                                <img src="{{asset('uploads/photos/'.$annonce->photos['0']->name)}}" alt="..." />
                            </div>
                            <div class="product_gallery">
                                @foreach($annonce->photos as $photo)
                                    <a class="imageAnnonceToSlide" >
                                        <img class="" src="{{asset('uploads/photos/'.$photo->name)}}"  alt="" />
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                            {{--<h3 class="prod_title">
                                {{$annonce->titre}}
                            </h3>--}}
                            <h1 class="price   btn-success">
                                    <label style="color:#ffffff;">
                                    {{$annonce->getAnnoncePrix()}}
                                    </label>
                            </h1>

                            <div class="">
                                <h2><strong>{{$annonce->getAnnonceCategorieTitle().' '}}</strong>{{$annonce->getAnnonceCategorieSuperficeorNombrepiece()}}</h2>
                            </div>
                            <div class="">
                                <h2> <strong>Categorie :</strong> {{$annonce->getAnnonceCategorie()}}</h2>
                            </div>
                            <div class="">
                                <h2><strong>Type : </strong>{{$annonce->getAnnonceTypeannonce()}}</h2>
                            </div>
                            <br />
                            <div class="">
                                <h2><strong>Lieu : </strong>{{$annonce->ville->name}}</h2>
                            </div>
                            <br />

                            <div class="">
                                <h2>Size <small>Please select one</small></h2>
                                <ul class="list-inline prod_size">
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Small</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Medium</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Large</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Xtra-Large</button>
                                    </li>
                                </ul>
                            </div>
                            <br />

                            <div class="">
                                <div class="product_price">
                                    <span class="price-tax">Frais de visite: 5000 Fcfa</span>
                                    <br>
                                </div>
                            </div>

                            <div class="">
                                <button type="button" class="btn btn-default btn-lg">Add to Cart</button>
                                <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
                            </div>

                            <div class="product_social">
                                <ul class="list-inline">
                                    <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-twitter-square"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-envelope-square"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-rss-square"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>


                        <div class="col-md-12">

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Description de l'annonce</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                        <p>{{$annonce->description}}</p>
                                    </div>
                                </div>
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
@endsection