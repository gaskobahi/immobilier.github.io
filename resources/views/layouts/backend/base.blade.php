<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title') </title>

    <!-- Bootstrap -->
    <link href="{{asset('gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{asset('gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('gentelella/vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <!-- iCheck -->
    <link href="{{asset('gentelella/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{asset('gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('gentelella/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('gentelella/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('gentelella/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    @yield('styles')
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">


        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('/admin')}}" class="site_title"><i class="fa fa-paw"></i> <span>Immobilier!</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        @if(Empty(Auth::user()->photo))
                            <img src="{{asset('uploads/users/avatar.jpg')}}"  width="35px" height="35px">
                        @else
                            <img src="{{asset('uploads/users/'.Auth::user()->photo )}}" alt="..." class="img-circle profile_img">
                        @endif
                    </div>
                    <div class="profile_info">
                        <span>Bienvenue,</span>
                        <h2>{{Auth::user()->pseudo}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info
                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Accueil <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('users.admin')}} ">Statistiques</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-user"></i> Membres <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    @if(Auth::user())
                                        @if(Auth::user()->hasRole('superadmin')||Auth::user()->hasRole('admin')||Auth::user()->hasRole('utilisateur'))
                                            @if(Auth::user()->role->hasPermission('show-user'))
                                            <li><a href="{{route('users.show')}}">Tous les membres</a></li>
                                            @endif
                                            @if(Auth::user()->role->hasPermission('add-user'))
                                                <li><a href="{{url('/register')}}">Ajouter</a></li>
                                             @endif
                                        @endif
                                    <li><a href="{{route('user.profile',Auth::user()->id)}}">Votre profil</a></li>
                                    @endif
                                </ul>
                            </li>
                            @if(Auth::user()->hasRole('superadmin')||Auth::user()->hasRole('admin'||Auth::user()->hasRole('utilisateur')))
                              <li><a><i class="fa fa-table"></i> Annonce <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        @if(Auth::user()->role->hasPermission('show-annonce'))
                                        <li><a href="{{route('annonce.index')}}">Tous les annonces</a></li>
                                        @endif
                                        @if(Auth::user()->role->hasPermission('add-annonce'))
                                        <li><a href="{{route('annonce.create')}}">Ajouter</a></li>
                                        @endif
                                    </ul>
                              </li>
                            @endif
                                @if(Auth::user()->hasRole('superadmin')||Auth::user()->hasRole('admin')))

                                <li><a><i class="fa fa-desktop"></i> Catégorie <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('categorie.index')}}">Toutes les catégories</a></li>
                                    @if(Auth::user()->role->hasPermission('add-categorie'))
                                    <li><a href="{{route('categorie.create')}}">Ajouter</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li><a><i class="fa fa-desktop"></i> Type annonce <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('typeannonce.index')}}">Tous les types d'annonces</a></li>
                                    @if(Auth::user()->role->hasPermission('add-typeannonce'))
                                    <li><a href="{{route('typeannonce.create')}}">Ajouter</a></li>
                                    @endif
                                </ul>
                            </li>

                             <li><a><i class="fa fa-desktop"></i> Ville <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{route('ville.index')}}">Tous les villes</a></li>
                                        @if(Auth::user()->role->hasPermission('add-ville'))
                                        <li><a href="{{route('ville.create')}}">Ajouter</a></li>
                                         @endif
                                    </ul>
                             </li>

                              <li><a><i class="fa fa-bar-chart-o"></i> Proprietaire <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{route('proprietaire.index')}}">Tous les Propriétaires</a></li>
                                        @if(Auth::user()->role->hasPermission('add-proprietaire'))
                                        <li><a href="{{route('proprietaire.create')}}">Ajouter</a></li>
                                         @endif
                                    </ul>
                               </li>

                            <li><a><i class="fa fa-table"></i> Titre de Propriété <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('titrepropriete.index')}}">Tous les titres de propriétés</a></li>
                                    @if(Auth::user()->role->hasPermission('add-titrepropriete'))
                                        <li><a href="{{route('titrepropriete.create')}}">Ajouter</a></li>
                                    @endif
                                </ul>
                            </li>

                                <li><a><i class="fa fa-table"></i> Rôle <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{route('role.index')}}">Tous les rôles</a></li>
                                        @if(Auth::user()->role->hasPermission('add-role'))
                                            <li><a href="{{route('role.create')}}">Ajouter</a></li>
                                        @endif
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-table"></i> Permission <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{route('permission.index')}}">Toutes les Permissions</a></li>
                                        @if(Auth::user()->role->hasPermission('add-permission'))
                                            <li><a href="{{route('permission.create')}}">Ajouter</a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::user())
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                @if(Empty(Auth::user()->photo))
                                    <img src="{{asset('uploads/users/avatar.jpg')}}" alt="">
                                @else
                                    <img src="{{asset('uploads/users/'.Auth::user()->photo )}}" alt="">
                                @endif
                                {{Auth::user()->pseudo}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{ route('user.profile',Auth::user()->id) }}"> <i class="fa fa-user" aria-hidden="true"></i>
                                        Profile</a></li>
                                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Deconnexion</a></li>
                            </ul>
                        </li>
                        @endif

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="gentelella/images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
        @yield('toptiles')

        <!-- /top tiles -->

            <!-- dashboardgraph -->
        @yield('dashboardgraph')
            <!-- end dashboardgraph -->

            <!-- appversion -->
            <!-- a defini -->
            <!-- end appversion -->
        @yield('content')

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div align="center">
                © 2016  <a href="http://www.primumci.com">Primum</a>.Tous droits réservés
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>



<!-- jQuery -->
<script src="{{asset('gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('gentelella/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>

<!-- FastClick -->
<script src="{{asset('js/bootbox.min.js')}}"></script>
<script src="{{asset('js/bootstrap-notify.min.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('gentelella/vendors/nprogress/nprogress.js')}}"></script>
<!-- Chart.js -->
<script src="{{asset('gentelella/vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{asset('gentelella/vendors/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('gentelella/vendors/iCheck/icheck.min.js')}}"></script>
<!-- Skycons -->
<script src="{{asset('gentelella/vendors/skycons/skycons.js')}}"></script>
<!-- Flot -->
<script src="{{asset('gentelella/vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('gentelella/vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('gentelella/vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('gentelella/vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('gentelella/vendors/Flot/jquery.flot.resize.js')}}"></script>
<!-- Flot plugins -->
<script src="{{asset('gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('gentelella/vendors/flot.curvedlines/curvedLines.js')}}"></script>

<!-- DateJS -->
<script src="{{asset('gentelella/vendors/DateJS/build/date.js')}}"></script>

<!-- JQVMap -->
<script src="{{asset('gentelella/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{asset('gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>

<!-- bootstrap-daterangepicker -->
<script src="{{asset('gentelella/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('gentelella/build/js/custom.min.js')}}"></script>
<script src="{{asset('gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('gentelella/vendors/switchery/dist/switchery.min.js')}}"></script>

@yield('script')

</body>
</html>
