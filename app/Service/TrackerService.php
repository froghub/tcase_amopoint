<?php

namespace App\Service;

use App\Models\TrackerLog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrackerService
{
    public function saveTrackData(array $data): void
    {
        TrackerLog::create($data);
        Log::info('Track data saved');
    }

    public function getPerHourData() : Collection
    {
        $data = DB::table('tracker_logs')
            ->selectRaw('COUNT(DISTINCT ip||ua) as VisitCount, strftime(\'%Y-%m-%d %H:00\', created_at) as PerHour')
            ->groupBy('PerHour')
            ->get();
        return $data->map(fn($item) => [
            'x' => $item->PerHour,
            'y' => $item->VisitCount]
        );
    }

    public function getByCityData() : array
    {
        $data = DB::table('tracker_logs')
            ->select('city')
            ->selectRaw('COUNT(city) as VisitCount')
            ->groupBy('city')
            ->get();
        $data = $data->groupBy('city')->map(function ($group) {
            return $group->sum('VisitCount');
        });
        return [
            'x' => $data->values(),
            'y' => $data->keys(),
        ];
    }
}
