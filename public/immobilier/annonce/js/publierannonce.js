var value;
function getanonceid(id){
   /* $('.btnannoncepublier_'+id).on('change',function(e) {
        e.preventDefault();*/
        if ($('.btnannoncepublier_'+id).is(":checked")){
            $('.btnannoncepublier_'+id).val('1');
            value=$('.btnannoncepublier_'+id).val();
        }else {
            $('.btnannoncepublier_'+id).val('0');
            value=$('.btnannoncepublier_'+id).val();
        }
        $.ajax({
            method:'POST',
            url:urlupdatestatutannonce,
            data:{
                id:id,
                status:value,
                _token:token
            }}).done(function(msg) {
            $('.statutpublicationannonce_'+msg['id']).empty();
            //$('.datestatutpublicationannonce_'+msg['id']).empty();
            $('.updatedstatusby_publicationannonce_'+msg['id']).empty();
            $('.updatedstatusby_publicationannonce_'+msg['id']).html(msg['updatedstatus_by']);
            if(msg['status']!=0){
               // $('.datestatutpublicationannonce_'+msg['id']).html(msg['publie_at']);
                $('.statutpublicationannonce_'+msg['id']).html('Publiée');
                $('.btnannoncepublier_'+msg['id']).attr('checked',true);
            }else{
                $('.statutpublicationannonce_'+msg['id']).html('Pas encore publiée');
                $('.btnannoncepublier_'+msg['id']).attr('checked',false);
            }
        }).fail(function (jqxhr) {
            var errors = jqxhr.responseJSON;
            //alert(errors);

        });

}


/*function getDateOfAnnonce(dat) {
    var dt = new Date(dat);

}*/


/*
function getDateOfAnnonce(dat){
    var dt = new Date(dat);
    if(returnAujourdhui(dat)===true){
        return 'Mise en ligne Aujourd\'hui à '.date_format(dt, 'H:i');
    }elseif(returnHier(dat)){
        return 'Mise en ligne Hier à '.date_format($dt, 'H:i');
    }else{
        getNameOfMonth(dt->month);
        return 'Mise en ligne le  '.dt->day +' '+getNameOfMonth($dt->month)+' à '+date_format(dt, 'H:i');
    }

}



function returnAujourdhui(val){
    var dt1= new Date(val);
    if(dt1.setDate(dt1.getDate())){
        return true;
    }
    return false;
}

 function returnHier(val){
     dt1= new Date(val)
    if(dt1.setDate(dt1.getDate() - 1)){
        return true;
    }
    return false;
}

 function getNameOfMonth(val) {
     var m = '';
     if (val == 1) {
         m = 'Janvier';
     }
     if ($val == 2) {
         m = 'Fevrier';
     }
     if (val == 3) {
         m = 'Mars';
     }
     if (val == 4) {
         m = 'Avril';
     }
     if (val == 5) {
         m = 'Mai';
     }
     if (val == 6) {
         m = 'Juin';
     }
     if (val == 7) {
         m = 'Juillet';
     }
     if (val == 8) {
         m = 'Aôut';
     }

     if (val == 9) {
         m = 'Septembre';
     }
     if (val == 10) {
         m = 'Octobre';
     }
     if (val == 11) {
         m = 'Novembre';
     }
     if (val == 12) {
         m = 'Decembre';
     }
     return m;

}*/


