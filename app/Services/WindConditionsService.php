<?php

namespace App\Services;

use App\Models\Spot;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WindConditionsService
{
    public function forSpotOnDate(Spot $spot, $date): ?array
    {
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $cacheKey = "wind-conditions:{$spot->latitude}:{$spot->longitude}:{$date}";

        return Cache::remember($cacheKey, now()->addDay(), function () use ($spot, $date) {
            return $this->fetch($spot, $date);
        });
    }

    private function fetch(Spot $spot, string $date): ?array
    {
        try {
            $response = Http::timeout(5)->get(config('services.open_meteo.forecast_url'), [
                'latitude'   => $spot->latitude,
                'longitude'  => $spot->longitude,
                'hourly'     => 'wind_speed_10m,wind_direction_10m,wind_gusts_10m',
                'start_date' => $date,
                'end_date'   => $date,
            ]);

            if (! $response->successful()) {
                return null;
            }

            return $this->extractNoonReading($response->json());
        } catch (\Throwable $e) {
            Log::warning("Wind conditions fetch failed: {$e->getMessage()}");
            return null;
        }
    }

    private function extractNoonReading(array $data): ?array
    {
        $times = $data['hourly']['time'] ?? [];
        $noonIndex = null;

        foreach ($times as $index => $timestamp) {
            if (str_ends_with($timestamp, '12:00')) {
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