<?php

namespace WebAppId\Bank\Seeds;

use Illuminate\Database\Seeder;
use WebAppId\Bank\Repositories\BankRepository;
use WebAppId\Bank\Repositories\Requests\BankRepositoryRequest;
use WebAppId\DDD\Tools\Lazy;

class BankSeeder extends Seeder
{
    public function run(BankRepository $bankRepository)
    {
        $csvToArray = new CsvtoArray;
        $file = __DIR__ . '/../resources/csv/bank.csv';
        $header = array('code', 'name', 'status');
        $data = $csvToArray->csvToArray($file, $header, '|');
        $collection = collect($data);

        foreach ($collection as $chunk) {
            $bankData = $this->container->call([$bankRepository, 'getByCode'], ['code' => $chunk["code"]]);
            if ($bankData == null) {
                $bankRepositoryRequest = $this->container->make(BankRepositoryRequest::class);
                try {
                    $bankRepositoryRequest = Lazy::copyFromArray($chunk, $bankRepositoryRequest, Lazy::AUTOCAST);

                    $this->container->call([$bankRepository, 'store'], compact('bankRepositoryRequest'));
                } catch (\Exception $e) {
                    report($e);
                }
            }
        }

    }
}
