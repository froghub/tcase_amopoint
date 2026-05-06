<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackLogSaveRequest;
use App\Models\TrackerLog;
use App\Service\TrackerService;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function __construct(public TrackerService $trackerService){}
    public function save(TrackLogSaveRequest $request) {
        $data = $request->validated();
        $data['ip'] = $request->ip();
        //Что касается города - тут нужен либо api сервис, либо локальная БД
        //В рамках тестового задания разворачивать ее я не буду, предоставлю только примерный код
        //Код этот должен будет располагаться в TrackerService
        /**
         * if ($position = Location::get($ip)) {
         * $data['city'] = $position->cityName;
         * } else {
         * $data['city'] = 'Unknown';
         * }
         */
        $faker = \Faker\Factory::create();
        $data['city'] = $faker->city();
        $this->trackerService->saveTrackData($data);
    }
    public function getTrackData()
    {
        $data = $this->trackerService->getPerHourData();
        $data = $this->trackerService->getByCityData();
        return response()->json($data);
    }

    public function index()
    {
        $hourly = $this->trackerService->getPerHourData();
        $city = $this->trackerService->getByCityData();

        return view('tracker.index', [
            'hourly' => $hourly,
            'city' => $city
        ]);
    }
}
