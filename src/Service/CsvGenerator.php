<?php

namespace App\Service;

class CsvGenerator {
    public function generateCSV($data, $filename) {
        
        $file = fopen($filename, 'w');

        if ($file) {
            // Write the header row
            fputcsv($file, array('amountToConvert', 'cuurencyInput', 'cuurencyOutput','totalAmount'));

            // Write data rows
            foreach ($data as $row) {
                fputcsv($file, $row);
            }


            fclose($file);
            return true; // File creation successful
        } else {
            return false; // File creation failed
        }
    }
}


?>
