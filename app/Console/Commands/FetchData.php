<?php

namespace App\Console\Commands;

use App\Service\ApiPayloadService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ApiPayloadService $apiPayloadService)
    {
        $url = "https://jsonplaceholder.typicode.com/todos/" . rand(1, 100);
        try {
            $response = Http::get($url);
            if($response->successful()) {
                $data = $response->json();
                if(!empty($data) && is_array($data) && isset($data['id'])) { // имитация валидации
                    $data = json_encode($data);
                    $apiPayloadService->save($data);
                    $this->info("Данные сохранены");
                } else {
                    $this->error('Некорректный результат запроса');
                }
            } else {
                $this->error('Некорректный ответ сервера');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
