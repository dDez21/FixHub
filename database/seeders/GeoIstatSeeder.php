<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Region;
use App\Models\Province;
use App\Models\City;

class GeoIstatSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/geo/Elenco-comuni-italiani.csv');
        if (!file_exists($path)) {
            throw new \RuntimeException("CSV ISTAT non trovato in: $path");
        }

        $fh = fopen($path, 'r');
        if (!$fh) throw new \RuntimeException("Impossibile aprire: $path");

        $header = fgetcsv($fh, 0, ';');
        if (!$header) throw new \RuntimeException("Header CSV vuoto");

        $H = array_map(fn($h) => trim(mb_strtolower($h ?? '')), $header);

        $col = function(array $needles) use ($H) {
            foreach ($needles as $n) {
                $n = mb_strtolower($n);
                foreach ($H as $i => $h) {
                    if (str_contains($h, $n)) return $i;
                }
            }
            return null;
        };

        $iRegCode   = $col(['codice regione']);
        $iRegName   = $col(['denominazione regione']);
        $iProvSigla = $col(["sigla automobilistica", 'sigla']);
        $iComName   = $col(['denominazione in italiano', 'denominazione comune', 'nome comune']);
        $iCap       = $col(['cap']); 

   
        foreach ([
            'codice regione' => $iRegCode,
            'nome regione'   => $iRegName,
            'sigla provincia'=> $iProvSigla,
            'nome comune'    => $iComName,
        ] as $k => $v) {
            if ($v === null) throw new \RuntimeException("Colonna mancante nel CSV ISTAT: $k");
        }

        $regions = [];
        $provinces = [];
        $cities = [];

        while (($row = fgetcsv($fh, 0, ';')) !== false) {
            $get = fn($i) => isset($row[$i]) ? trim($row[$i]) : null;

            $regCode = str_pad((string)$get($iRegCode), 2, '0', STR_PAD_LEFT);
            $regName = $get($iRegName);

            $provSigla = strtoupper((string)$get($iProvSigla));
            $provName  = $provSigla;

            $cityName  = $get($iComName);

            $cap = $iCap !== null ? $get($iCap) : null;
            if ($cap) $cap = str_pad(preg_replace('/\D+/', '', $cap), 5, '0', STR_PAD_LEFT);

            if (!$regCode || !$regName || !$provSigla || !$cityName) continue;

            $regions[$regCode] = ['name' => $regName, 'code' => $regCode];

            $provinces[$regCode.'|'.$provSigla] = [
                'region_code' => $regCode,
                'code' => $provSigla,
                'name' => $provName,
            ];

            $cities[$regCode.'|'.$provSigla.'|'.$cityName] = [
                'region_code' => $regCode,
                'province_code' => $provSigla,
                'name' => $cityName,
                'cap' => $cap,
            ];
        }
        fclose($fh);

        DB::transaction(function () use ($regions, $provinces, $cities) {

            Region::upsert(array_values($regions), ['code'], ['name']);
            $regionIdByCode = Region::pluck('id', 'code')->all();

            $provRows = [];
            foreach ($provinces as $p) {
                $rid = $regionIdByCode[$p['region_code']] ?? null;
                if (!$rid) continue;

                $provRows[] = [
                    'region_id' => $rid,
                    'code' => $p['code'],
                    'name' => $p['name'],
                ];
            }
            Province::upsert($provRows, ['region_id','code'], ['name']);

            $provId = Province::get()->mapWithKeys(fn($p) => [$p->region_id.'|'.$p->code => $p->id])->all();

            $cityRows = [];
            foreach ($cities as $c) {
                $rid = $regionIdByCode[$c['region_code']] ?? null;
                if (!$rid) continue;

                $pid = $provId[$rid.'|'.$c['province_code']] ?? null;
                if (!$pid) continue;

                $cityRows[] = [
                    'province_id' => $pid,
                    'name' => $c['name'],
                    'cap' => $c['cap'],
                ];
            }
            City::upsert($cityRows, ['province_id','name'], ['cap']);
        });
    }
}
