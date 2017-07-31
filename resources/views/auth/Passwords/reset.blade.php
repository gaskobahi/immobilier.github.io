<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mot de passe oublié </title>

    <!-- Bootstrap -->
    <link href="../../gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../../gentelella/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../gentelella/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form  role="form" method="POST" action="{{ url('password/reset') }}">
                    {{ csrf_field() }}
                    <h1>Rénitialisation mot de passe</h1>
                    <div class="separator">

                        <div class="clearfix"></div>
                        <br />
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email" >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} ">
                           <input id="password" type="password" class="form-control" name="password"  placeholder="Nouveau mot de passe">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                            @endif
                    </div>
                    <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmer nouveau mot de passe">
                            @if ($errors->has('password-confirm'))
                                <span class="help-block">
                                       <strong>{{ $errors->first('password-confirm') }}</strong>
                                 </span>
                            @endif
                    </div>


                    <div>
                        <a  href="{{route('login')}}"><strong>Retour</strong></a>
                        <button class="btn btn-success" type="submit">Valider</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Primum Immobilier!</h1>
                            <p>©2017 Tous droits reservés. Primum Immobilier! </p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

    </div>
</div>
</body>
</html>