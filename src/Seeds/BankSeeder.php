<?php
namespace WebAppId\Bank\Seeds;

use Illuminate\Database\Seeder;
use WebAppId\Bank\Models\Bank;

class BankSeeder extends Seeder
{
    public function run()
    {
        $csvToArray = new CsvtoArray;
        $file = __DIR__ . '/../resources/csv/bank.csv';
        $header = array('code','name', 'status');
        $data = $csvToArray->csvToArray($file, $header, '|');
        $collection = collect($data);
        $bank = new Bank;

        foreach ($collection as $chunk) {
            $bankData = $bank->getBank($chunk["code"]);
            if ($bankData == null) {
                $bank->addBank((object) $chunk);
            }
        }

    }
}
