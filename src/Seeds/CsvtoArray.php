<?php
/**
 * original source from https://github.com/laravolt/indonesia/blob/master/src/Seeds/CsvtoArray.php
 */
namespace WebAppId\Bank\Seeds;

class CsvtoArray
{
    public function csvToArray($filename = '', $header, $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
