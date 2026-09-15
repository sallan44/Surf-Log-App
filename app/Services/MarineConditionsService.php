<?php

namespace App\Services;

use App\Models\Spot;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MarineConditionsService
{
    public function forSpotOnDate(Spot $spot, $date): ?array
    {
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $cacheKey = "marine-conditions:{$spot->latitude}:{$spot->longitude}:{$date}";

        return Cache::remember($cacheKey, now()->addDay(), function () use ($spot, $date) {
            return $this->fetch($spot, $date);
        });
    }
    
    private function fetch(Spot $spot, string $date): ?array
    {
        try {
            $response = Http::timeout(5)->get(config('services.open_meteo.marine_url'), [
                'latitude'   => $spot->latitude,
                'longitude'  => $spot->longitude,
                'hourly'     => 'swell_wave_height,swell_wave_period,swell_wave_direction,sea_level_height_msl',
                'start_date' => $date,
                'end_date'   => $date,
            ]);

            if (! $response->successful()) {
                return null;
            }

            return $this->extractNoonReading($response->json());
        } catch (\Throwable $e) {
            Log::warning("Marine conditions fetch failed: {$e->getMessage()}");
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
            'swell_height'    => $data['hourly']['swell_wave_height'][$noonIndex] ?? null,
            'swell_period'    => $data['hourly']['swell_wave_period'][$noonIndex] ?? null,
            'swell_direction' => $data['hourly']['swell_wave_direction'][$noonIndex] ?? null,
            'sea_level'       => $data['hourly']['sea_level_height_msl'][$noonIndex] ?? null,
        ];
    }

}