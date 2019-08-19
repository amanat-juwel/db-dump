<?php



Route::namespace('Amanatjuwel\DbDump\Http\Controllers')->group(function () {
   
    Route::get('/database-backup','DatabaseBackupController@index');

    Route::get('/database-backup/create','DatabaseBackupController@create');
    
    Route::delete('/database-backup/delete','DatabaseBackupController@destroy');

});




