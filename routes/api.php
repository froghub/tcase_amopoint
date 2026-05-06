<?php

use App\Http\Controllers\ApiPayloadController;
use App\Http\Controllers\TrackerController;

Route::get('api-payload',ApiPayloadController::class);
Route::group(['prefix' => 'tracker'], function () {
    Route::post('track', [TrackerController::class, 'save']);
    Route::get('get-data',[TrackerController::class, 'getTrackData']);
    Route::get('',[TrackerController::class, 'index']); //Этот маршрут должен быть в web.php. Оставляю здесь только ради того что бы не размазывать
});
