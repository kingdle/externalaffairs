<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();
    return new \App\Http\Resources\User($user);
});
Route::middleware('auth:api')->get('/shop', function (Request $request) {
    $user = $request->user();
    $shop = \App\Shop::where('user_id', $user->id)->get();
    return $shop[0];
});

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->middleware('auth:api');
Route::post('/token/refresh', 'Auth\LoginController@refresh');

Route::post('/user/profile/update', 'UsersController@update')->middleware('auth:api');

//passport部分
Route::group(['prefix' => '/v1', 'middleware' => 'cors'], function () {
    Route::resource('/abroads', 'AbroadsController')->middleware('auth:api');
    Route::post('/abroad/update', 'AbroadsController@update')->middleware('auth:api');
    Route::post('/abroad/listSize', 'AbroadsController@listSize')->middleware('auth:api');
    Route::post('/abroad/upFile', 'AbroadsController@upFile')->middleware('auth:api');
    Route::post('/abroad/destroyImage', 'AbroadsController@destroyImage')->middleware('auth:api');
    Route::get('/abroad/queryNameList', 'AbroadsController@queryNameList')->middleware('auth:api');
    Route::get('/abroad/queryDepartmentList', 'AbroadsController@queryDepartmentList')->middleware('auth:api');
    Route::post('/abroad/queryResult', 'AbroadsController@queryResult')->middleware('auth:api');


    //接待管理
    Route::resource('/receptions', 'ReceptionsController')->middleware('auth:api');
    Route::post('/reception/update', 'ReceptionsController@update')->middleware('auth:api');
    Route::post('/reception/listSize', 'ReceptionsController@listSize')->middleware('auth:api');
    Route::post('/reception/upFile', 'ReceptionsController@upFile')->middleware('auth:api');
    Route::post('/reception/destroyImage', 'ReceptionsController@destroyImage')->middleware('auth:api');
    Route::get('/reception/queryNationList', 'ReceptionsController@queryNationList')->middleware('auth:api');
    Route::get('/reception/queryDepartmentList', 'ReceptionsController@queryDepartmentList')->middleware('auth:api');
    Route::post('/reception/queryResult', 'ReceptionsController@queryResult')->middleware('auth:api');


    //users用户
    Route::resource('/users', 'UsersController')->middleware('auth:api');
    //上传图片
    Route::post('/imageUpload','UsersController@imageUpload')->middleware('auth:api');
    //configs控制信息
    Route::resource('/configs', 'ConfigsController');
    //登录
    Route::post('/login', 'UsersController@weapplogin');


    //sorts分类查询




//    //第三方登录(微信)
//    Route::post('socials/{social_type}/authorizations','AuthorizationsController@socialStore');
//    Route::post('authorizations','AuthorizationsController@store');
//    // 小程序登录
//    Route::post('weapp/authorizations', 'AuthorizationsController@weappStore');
//    // 小程序注册
//    Route::post('weapp/users', 'UsersController@weappStore');
//    // 刷新token
//    Route::put('authorizations/current', 'AuthorizationsController@update');
//    // 删除token
//    Route::delete('authorizations/current', 'AuthorizationsController@destroy');

});

//dingo部分
$api = app('Dingo\Api\Routing\Router');

$api->version('v2', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        $api->post('v2/weappLogin', 'AuthorizationsController@weappLogin');
        $api->post('v2/weappRegister', 'AuthorizationsController@weappRegister');
        $api->post('v2/weappShopRegister', 'AuthorizationsController@weappShopRegister');
        $api->post('v2/logout', 'AuthorizationsController@destroy');
        $api->post('v2/token/refresh', 'AuthorizationsController@update');


    });
});

