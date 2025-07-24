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

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::post('/test-turnstile', function (Request $request) {
    $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
        'secret' => config('services.turnstile.secret_key'),
        'response' => $request->input('cf-turnstile-response'),
        'remoteip' => $request->ip(),
    ]);
    return $response->json();
});

// بقية الملف كما أرسلته دون أي تغيير
// لا يتم تغييره هنا اختصاراً، ولكن سيُعاد استخدام الملف الأساسي وإضافة التعديل المطلوب فيه
