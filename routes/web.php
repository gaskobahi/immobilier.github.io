<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {


    ///Route::get('/',['uses' => 'Auth\RegisterController@admin'])->name('users.admin');


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        Route::get('/admin',['uses' => 'Auth\RegisterController@admin'])->name('users.admin');
        Route::get('/utilisateurs',['uses' => 'Auth\RegisterController@showUsers'])->name('users.show');
        Route::get('/edit/{id}',['uses' => 'Auth\RegisterController@edit'])->name('user.edit');
        Route::post('/edit/{id}',['uses' => 'Auth\RegisterController@update'])->name('user.update');
        Route::get('/profile/{id}',['uses' => 'Auth\RegisterController@profile'])->name('user.profile');
        Route::get('/updatepassword/{id}',['uses' => 'Auth\RegisterController@updatepassword'])->name('user.updatepassword');
        Route::post('/updatepasswordpost',['uses' => 'Auth\RegisterController@updatepasswordpost'])->name('user.updatepasswordpost');
        Route::get('/userdelete/{id}',['uses' => 'Auth\RegisterController@userdelete'])->name('user.delete');
        Route::post('/confirmuserdelete/{id}',['uses' => 'Auth\RegisterController@confirmuserdelete'])->name('user.confirmdelete');

        Route::group(['prefix' => 'role'], function () {
        Route::get('/',['uses' => 'RoleController@index'])->name('role.index');
        Route::get('create',['uses' => 'RoleController@create'])->name('role.create');
        Route::post('store',['uses' => 'RoleController@store'])->name('role.store');
        Route::get('/edit',['uses' => 'RoleController@edit'])->name('role.edit');
        Route::post('/edit/{id}',['uses' => 'RoleController@update'])->name('role.update');
        Route::get('/profile/{id}',['uses' => 'RoleController@profile'])->name('role.profile');
        Route::get('/rolepermissionindex/{id}',['uses' => 'RoleController@rolepermissionindex'])->name('role.rolepermissionindex');
        Route::post('/addpermissiontorole',['uses' => 'RoleController@addpermissiontorole'])->name('permissionrole.addpermissiontorole');
        Route::post('/detachpermissionfromrole',['uses' => 'RoleController@detachpermissionfromrole'])->name('permissionrole.detachpermissionfromrole');
        Route::post('/roleaddfromregisteruser',['uses' => 'RoleController@roleaddfromregisteruser'])->name('permissionrole.roleaddfromregisteruser');

        });

        Route::group(['prefix' => 'permission'], function () {
            Route::get('/',['uses' => 'PermissionController@index'])->name('permission.index');
            Route::get('create',['uses' => 'PermissionController@create'])->name('permission.create');
            Route::post('store',['uses' => 'PermissionController@store'])->name('permission.store');
            Route::get('/edit',['uses' => 'PermissionController@edit'])->name('permission.edit');
            Route::post('/edit/{id}',['uses' => 'PermissionController@update'])->name('permission.update');
            Route::get('/profile/{id}',['uses' => 'PermissionController@profile'])->name('permission.profile');
        });



    Route::group(['prefix' => 'typeannonce'], function () {
//Route::get('notes/{id}',['uses' => 'NotesController@create'])->name('notebooks.create');});
        Route::get('/',['uses' => 'TypeannonceController@index'])->name('typeannonce.index');
        Route::get('create',['uses' => 'TypeannonceController@create'])->name('typeannonce.create');
        Route::post('store',['uses' => 'TypeannonceController@store'])->name('typeannonce.store');
        Route::get('edit/{id}',['uses' => 'TypeannonceController@edit'])->name('typeannonce.edit');
        Route::post('update/{id}',['uses' => 'TypeannonceController@update'])->name('typeannonce.update');
  //  Route::put('edit/{id}',['uses' => 'NotesController@update'])->name('notes.update');
        Route::post('destroy',['uses' => 'TypeannonceController@destroy'])->name('typeannonce.destroy');
        Route::post('/addajax',['uses' => 'TypeannonceController@typeannonceaddajax'])->name('TypeannonceController.typeannonceaddajax');


        Route::get('/typeannoncedelete/{id}',['uses' => 'TypeannonceController@typeannoncedelete'])->name('typeannonce.delete');
        Route::post('/confirmtypeannoncedelete/{id}',['uses' => 'TypeannonceController@confirmtypeannoncedelete'])->name('typeannonce.confirmtypeannoncedelete');


    });


    Route::group(['prefix' => 'categorie'], function () {
        Route::get('/',['uses' => 'CategorieController@index'])->name('categorie.index');
        Route::get('create',['uses' => 'CategorieController@create'])->name('categorie.create');
        Route::post('store',['uses' => 'CategorieController@store'])->name('categorie.store');
        Route::get('edit/{id}',['uses' => 'CategorieController@edit'])->name('categorie.edit');
        Route::post('update/{id}',['uses' => 'CategorieController@update'])->name('categorie.update');
        Route::post('/addajax',['uses' => 'CategorieController@categorieaddajax'])->name('categorie.categorieaddajax');

        Route::get('/categoriedelete/{id}',['uses' => 'CategorieController@categoriedelete'])->name('categorie.delete');
        Route::post('/confirmcategoriedelete/{id}',['uses' => 'CategorieController@confirmcategoriedelete'])->name('categorie.confirmcategoriedelete');

    });

    Route::group(['prefix' => 'ville'], function () {
        Route::get('/',['uses' => 'VilleController@index'])->name('ville.index');
        Route::get('create',['uses' => 'VilleController@create'])->name('ville.create');
        Route::post('store',['uses' => 'VilleController@store'])->name('ville.store');
        Route::get('edit/{id}',['uses' => 'VilleController@edit'])->name('ville.edit');
        Route::post('update/{id}',['uses' => 'VilleController@update'])->name('ville.update');
    });


    Route::group(['prefix' => 'proprietaire'], function () {
        Route::get('/',['uses' => 'ProprietaireController@index'])->name('proprietaire.index');
        Route::get('create',['uses' => 'ProprietaireController@create'])->name('proprietaire.create');
        Route::post('store',['uses' => 'ProprietaireController@store'])->name('proprietaire.store');
        Route::get('edit/{id}',['uses' => 'ProprietaireController@edit'])->name('proprietaire.edit');
        Route::post('update/{id}',['uses' => 'ProprietaireController@update'])->name('proprietaire.update');
        Route::post('/addajax',['uses' => 'ProprietaireController@proprietaireaddajax'])->name('ProprietaireController.proprietaireaddajax');

    });

    Route::group(['prefix' => 'titrepropriete'], function () {
        Route::get('/',['uses' => 'TitreproprieteController@index'])->name('titrepropriete.index');
        Route::get('create',['uses' => 'TitreproprieteController@create'])->name('titrepropriete.create');
        Route::post('store',['uses' => 'TitreproprieteController@store'])->name('titrepropriete.store');
        Route::get('edit/{id}',['uses' => 'TitreproprieteController@edit'])->name('titrepropriete.edit');
        Route::post('update/{id}',['uses' => 'TitreproprieteController@update'])->name('titrepropriete.update');
        Route::post('/addajax',['uses' => 'TitreproprieteController@titreproprieteaddajax'])->name('TitreproprieteController.titreproprieteaddajax');
    });



    Route::group(['prefix' => 'annonce'], function () {
        Route::get('/',['uses' => 'AnnonceController@index'])->name('annonce.index');
        Route::get('create',['uses' => 'AnnonceController@create'])->name('annonce.create');
        Route::post('upload',['uses' => 'AnnonceController@upload'])->name('annonce.upload');
        Route::get('edit/{id}',['uses' => 'AnnonceController@edit'])->name('annonce.edit');
        Route::post('update/{id}',['uses' => 'AnnonceController@update'])->name('annonce.update');
        Route::get('detailajax',['uses' => 'AnnonceController@detailajax'])->name('annonce.detailajax');
        Route::get('detail/{id}',['uses' => 'AnnonceController@detail'])->name('annonce.detail');
        Route::get('removephoto',['uses' => 'AnnonceController@removephoto'])->name('annonce.removephoto');
        Route::get('/annoncedelete/{id}',['uses' => 'AnnonceController@annoncedelete'])->name('annonce.delete');
        Route::post('/confirmannoncedelete/{id}',['uses' => 'AnnonceController@confirmannoncedelete'])->name('annonce.confirmannoncedelete');


        Route::post('updatestatutannonce',['uses' => 'AnnonceController@updatestatutannonce'])->name('annonce.updatestatutannonce');
        Route::post('updateexpireannonce',['uses' => 'AnnonceController@updateexpireannonce'])->name('annonce.updateexpireannonce');



    });
});


Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/login');
});

Auth::routes();