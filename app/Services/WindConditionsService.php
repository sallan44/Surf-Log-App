<?php

namespace App\Services;

use App\Models\Spot;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WindConditionsService
{
    public function forSpotOnDate(Spot $spot, $date, $time): ?array
    {
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $time = \Carbon\Carbon::parse($time)->format('H:00');
        $cacheKey = "wind-conditions:{$spot->latitude}:{$spot->longitude}:{$date}:{$time}";

        return Cache::remember($cacheKey, now()->addDay(), function () use ($spot, $date, $time) {
            return $this->fetch($spot, $date, $time);
        });
    }

    private function fetch(Spot $spot, string $date, string $time): ?array
    {
        try {
            $response = Http::timeout(5)->get(config('services.open_meteo.forecast_url'), [
                'latitude'   => $spot->latitude,
                'longitude'  => $spot->longitude,
                'hourly'     => 'wind_speed_10m,wind_direction_10m,wind_gusts_10m',
                'timezone'   => 'auto',
                'start_date' => $date,
                'end_date'   => $date,
            ]);

            if (! $response->successful()) {
                return null;
            }

            return $this->extractTimeReading($response->json(), $time);
        } catch (\Throwable $e) {
            Log::warning("Wind conditions fetch failed: {$e->getMessage()}");
            return null;
        }
    }

    private function extractTimeReading(array $data, string $time): ?array
    {
        $times = $data['hourly']['time'] ?? [];
        $noonIndex = null;

        foreach ($times as $index => $timestamp) {
            if (str_ends_with($timestamp, $time)) {
                $noonIndex = $index;
                break;
            }
        }

        if ($noonIndex === null) {
            return null;
        }

        return [
            'wind_speed'     => $data['hourly']['wind_speed_10m'][$noonIndex] ?? null,
            'wind_direction' => $data['hourly']['wind_direction_10m'][$noonIndex] ?? null,
            'wind_gusts'     => $data['hourly']['wind_gusts_10m'][$noonIndex] ?? null,
        ];
    }
}