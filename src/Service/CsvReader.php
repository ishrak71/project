<?php

namespace App\Service;

class CsvReader {
    private $filename;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function readCSV() {
        // Check if the file exists
        if (!file_exists($this->filename)) {
            die("The file '{$this->filename}' does not exist.");
        }

        // Open the CSV file for reading
        $file = fopen($this->filename, 'r');

        // Check if the file was opened successfully
        if (!$file) {
            die("Unable to open the file '{$this->filename}' for reading.");
        }

        $data = [];

        // Read data from the CSV file
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }

        // Close the CSV file
        fclose($file);

        return $data;
    }
}


