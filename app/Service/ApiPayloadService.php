<?php

namespace App\Service;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ApiPayloadService
{
    public function save(string $payload) : void {
        DB::table('api_payload')->insert(['payload' => $payload]);
    }
    public function list() : Collection {
        return DB::table('api_payload')->get();
    }
}
