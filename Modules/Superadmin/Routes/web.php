<?php

Route::group(['middleware' => ['web', 'auth', 'setData', 'SetSessionData', 'language', 'timezone', 'AdminSidebarMenu', 'CheckUserLogin']], function () {
    Route::get('/superadmin/businesses/{id}/confirm-delete', 'Modules\Superadmin\Http\Controllers\BusinessController@confirmDelete')->name('superadmin.business.confirm_delete');
Route::delete('/superadmin/businesses/{id}/destroy', 'Modules\Superadmin\Http\Controllers\BusinessController@destroy')->name('superadmin.business.destroy');
});
