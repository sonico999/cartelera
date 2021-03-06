<?php

Route::get('/', function () {
    if (Auth::check()) {
        return View::make('layout');
    } else {
        if (Session::has('iduser'))
            Session::flush();

        return View::make('login');
    }
});

//login y logout
Route::post('login', ['as' => 'login', 'uses' => 'UserLogin@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'UserLogin@logOut']);

//borramos los datos de session guardados
Route::get('flush', function () {
//    Session::flush();
});

Route::group(array('before' => 'auth|perfil'), function () {
    Route::get('menu', ['as' => 'menu', 'uses' => 'ModulosController@getModulos']);

//mantinimiento de modulos
    Route::get('modulos', ['as' => 'modulos', 'uses' => 'ModulosController@index']);
    Route::post('modulos/list', ['as' => 'listModulos', 'uses' => 'ModulosController@listar']);
    Route::post('modulos/update', ['as' => 'updateModulos', 'uses' => 'ModulosController@editar']);
    Route::post('modulos/create', ['as' => 'createModulos', 'uses' => 'ModulosController@nuevo']);
    Route::post('modulos/delete', ['as' => 'deleteModulos', 'uses' => 'ModulosController@eliminar']);
    Route::post('modulos/parents', ['as' => 'parentsModulos', 'uses' => 'ModulosController@padres']);

//perfiles
    Route::get('perfiles', ['as' => 'perfiles', 'uses' => 'PerfilesController@index']);
    Route::post('perfiles/list', ['as' => 'listPerfiles', 'uses' => 'PerfilesController@listar']);
    Route::post('perfiles/update', ['as' => 'updatePerfiles', 'uses' => 'PerfilesController@editar']);
    Route::post('perfiles/create', ['as' => 'createPerfiles', 'uses' => 'PerfilesController@nuevo']);
    Route::post('perfiles/delete', ['as' => 'deletePerfiles', 'uses' => 'PerfilesController@eliminar']);

//permisos
    Route::get('permisos', ['as' => 'permisos', 'uses' => 'PermisosController@index']);
    Route::get('permisos/getPerfils', ['as' => 'permisos.getPerfiles', 'uses' => 'PerfilesController@listar']);
    Route::get('permisos/listar', ['as' => 'permisos.listar', 'uses' => 'PermisosController@listar']);
    Route::get('permisos/getPermisos', ['as' => 'permisos.getPermisos', 'uses' => 'PermisosController@getPermisos']);
    Route::post('permisos/add', ['as' => 'permisos.add', 'uses' => 'PermisosController@add']);
    Route::post('permisos/del', ['as' => 'permisos.del', 'uses' => 'PermisosController@destroy']);


//users
    Route::get('usuarios', ['as' => 'usuarios', 'uses' => 'UsersController@index']);
    Route::post('usuarios/list', ['as' => 'usuarios.list', 'uses' => 'UsersController@listar']);
    Route::post('usuarios/update', ['as' => 'usuarios.update', 'uses' => 'UsersController@editar']);
    Route::post('usuarios/create', ['as' => 'usuarios.create', 'uses' => 'UsersController@nuevo']);
    Route::post('usuarios/delete', ['as' => 'usuarios.delete', 'uses' => 'UsersController@eliminar']);
    Route::post('usuarios/getPerfiles', ['as' => 'usuarios.getPerfiles', 'uses' => 'PerfilesController@getPerfiles']);
    Route::post('usuarios/getFacultad', ['as' => 'usuarios.getFacultad', 'uses' => 'UsersController@eliminar']);
    Route::get('miperfil', ['as' => 'miperfil', 'uses' => 'UsersController@show']);

//facultades
    Route::get('facultades', ['as' => 'facultades', 'uses' => 'FacultadesController@index']);
    Route::post('facultades/list', ['as' => 'facultades.list', 'uses' => 'FacultadesController@listar']);

//escuelaprofesional
    Route::get('escuelas', ['as' => 'facultades', 'uses' => 'EscuelasController@index']);
    Route::post('escuelas/list', ['as' => 'facultades.list', 'uses' => 'EscuelasController@listar']);

//escuelaprofesional
    Route::get('alumnos', ['as' => 'alumnos', 'uses' => 'AlumnosController@index']);
    Route::post('alumnos/list', ['as' => 'alumnos.list', 'uses' => 'AlumnosController@listar']);

//escuelaprofesional
    Route::get('profesores', ['as' => 'profesores', 'uses' => 'ProfesoresController@index']);
    Route::post('profesores/list', ['as' => 'profesores.list', 'uses' => 'ProfesoresController@listar']);

//reportes
    Route::get('reportes', ['as' => 'reportes', 'uses' => 'PerfilesController@index']);
});

Route::group(array('before' => 'auth'), function () {
//login con facebook
    Route::get('login/fb', ['as' => 'login.fb', 'uses' => 'UsersController@loginFb']);
    Route::get('login/fb/callback', ['as' => 'login.fb.callback', 'uses' => 'UsersController@fbCallback']);

    //BacboneJS
    Route::resource('comunicados', 'ComunicadosController');
    Route::resource('comentario', 'ComentariosController');
    Route::resource('votoscomentario', 'VotosComentariosController');
    Route::resource('votoscomunicado', 'VotosComunicadosController');
    Route::resource('images', 'ImagesController');
    Route::resource('cursos', 'CursosController');


});

//cambiar contraseña antes de entrar
Route::get('changepassword', ['as' => 'changepassword', 'uses' => 'UserLogin@changePassword']);
Route::post('changepasswordpost', ['as' => 'changepasswordpost', 'uses' => 'UsersController@changePassword']);


//error
Route::get('error404', function () {
    return View::make('error404');
});

App::missing(function ($exception) {
    // shows an error page (app/views/error404.blade.php)
    // returns a page not found error
    if (Auth::check()) {
        return Redirect::to('error404');
    } else {
        return Redirect::action('/');
    }
});
Route::get('login', function () {
    return Redirect::to('/');
});












