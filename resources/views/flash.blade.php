@if(Session::has('ok'))
    <div class=" alert alert-success">
        <p align="center">{{Session::get('ok')}}</p>
    </div>
@endif

@if(Session::has('error'))
    <div class=" alert alert-warning">
        <p align="center">{{Session::get('error')}}</p>
    </div>
@endif

@if(Session::has('statusshowuser'))
    <div class=" alert alert-success">
        <p align="center">{{Session::get('statusshowuser')}}</p>
    </div>
@endif

@if(Session::has('statusshowannonce'))
    <div class=" alert alert-success">
        <p align="center">{{Session::get('statusshowannonce')}}</p>
    </div>
@endif


@if(Session::has('statusshowcategorie'))
    <div class=" alert alert-success">
        <p align="center">{{Session::get('statusshowcategorie')}}</p>
    </div>
@endif


@if(Session::has('cptinactif'))
    <div class=" alert alert-danger">
        <p align="center">{{Session::get('cptinactif')}}</p>
    </div>
@endif
