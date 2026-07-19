@php
defined('BASEPATH') || exit('No direct script access allowed');

if (!class_exists('HolidayHelper')) {
    class HolidayHelper {
        public static function getHolidays($year = null) {
            if (!$year) {
                $year = date('Y');
            }
            $cacheFile = sys_get_temp_dir() . "/opensid_holidays_{$year}.json";
            
            if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < 86400)) {
                $cachedData = json_decode(file_get_contents($cacheFile), true);
                if (!empty($cachedData)) {
                    return $cachedData;
                }
            }
            
            $holidays = self::fetchFromApi($year);
            if (!empty($holidays)) {
                file_put_contents($cacheFile, json_encode($holidays));
                return $holidays;
            }
            
            return [];
        }
        
        private static function fetchFromApi($year) {
            $apiKey = theme_config('api_co_id_key');
            
            // 1. Try api.co.id if key is provided
            if (!empty($apiKey)) {
                $url = "https://api.co.id/api/indonesian-holidays?year={$year}";
                $options = [
                    'http' => [
                        'header' => "x-api-co-id: {$apiKey}\r\n",
                        'method' => 'GET',
                        'timeout' => 5
                    ]
                ];
                $context = stream_context_create($options);
                $response = @file_get_contents($url, false, $context);
                if ($response !== false) {
                    $data = json_decode($response, true);
                    if (!empty($data) && (isset($data['data']) || is_array($data))) {
                        $items = isset($data['data']) ? $data['data'] : $data;
                        $normalized = [];
                        foreach ($items as $item) {
                            $normalized[] = [
                                'date' => $item['date'] ?? $item['tanggal'] ?? '',
                                'name' => $item['name'] ?? $item['description'] ?? $item['keterangan'] ?? ''
                            ];
                        }
                        return $normalized;
                    }
                }
            }
            
            // 2. Fallback to Tanggal Merah API
            $url = "https://tanggalmerah.upset.dev/api/holidays?year={$year}";
            $options = ['http' => ['method' => 'GET', 'timeout' => 5]];
            $context = stream_context_create($options);
            $response = @file_get_contents($url, false, $context);
            if ($response !== false) {
                $data = json_decode($response, true);
                if (!empty($data) && isset($data['success']) && $data['success'] && !empty($data['data'])) {
                    $normalized = [];
                    foreach ($data['data'] as $item) {
                        $normalized[] = [
                            'date' => $item['date'],
                            'name' => $item['name']
                        ];
                    }
                    return $normalized;
                }
            }
            
            // 3. Fallback to Vercel API
            $url = "https://api-hari-libur.vercel.app/api?year={$year}";
            $response = @file_get_contents($url, false, $context);
            if ($response !== false) {
                $data = json_decode($response, true);
                if (!empty($data) && isset($data['status']) && $data['status'] === 'success' && !empty($data['data'])) {
                    $normalized = [];
                    foreach ($data['data'] as $item) {
                        $normalized[] = [
                            'date' => $item['date'],
                            'name' => $item['description']
                        ];
                    }
                    return $normalized;
                }
            }
            
            return [];
        }

        public static function getTodayHoliday() {
            $today = date('Y-m-d');
            $holidays = self::getHolidays(date('Y'));
            foreach ($holidays as $h) {
                if ($h['date'] === $today) {
                    return $h['name'];
                }
            }
            return null;
        }
    }
}
@endphp
