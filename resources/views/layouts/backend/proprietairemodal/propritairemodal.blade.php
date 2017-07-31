<div class="modal  fade add-modal_proprietaire" tabindex="-1" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">*</button>
                <h5 id="myModalLabel">Ajouter un Proprietaire</h5>
            </div>
            <form class="form-horizontal" >
                <div class="modal-body">
                    <div class="error_add_proprietaire "></div>
                    <div  class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="nameprop" class="form-control col-md-7 col-xs-12 name" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nom" required="required" type="text">
                        </div>
                    </div>
                    <div  class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 surname" for="surname">Prénom(s) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="surnameprop" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="surname" placeholder="Prénom(s)" required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Genre
                            <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="sexe" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input id="sexe" class="sexeprop" type="radio" checked="checked" name="sexe" value="m"> &nbsp; Masculin &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input id="sexe" class="sexeprop"  type="radio" name="sexe" value="f"> Feminin
                                </label>
                            </div>
                        </div>
                    </div>
                    <div  class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone1">Téléphone1 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="phone1prop" class="form-control col-md-7 col-xs-12 phone1" data-validate-length-range="6" data-validate-words="2" name="phone1" placeholder="Téléphone1" required="required" type="text">
                        </div>
                    </div>
                    <div  class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone2">Téléphone2<span class="required"></span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="phone2prop" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="phone2" placeholder="Téléphone2" required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Lieu d'habitation<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="ville_idprop" name="ville_id" class="form-control ville_id">
                                <option value="">Choisir la ville </option>
                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}">
                                        {{$ville->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button onclick="emptydataproprietaireform()" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                                <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fermer
                            </button>
                            <button type="button" id="proprietaire_add_save" class="btn btn-success"  aria-hidden="true">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Enrégistrer
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="token" value="{{Session::token()}}">
            </form>
        </div>
    </div>
</div>
