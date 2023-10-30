<?php

namespace App\FileProcessors;

use App\FileProcessors\Contracts\FileReaderInterface;
use Exception;

class FileReader implements FileReaderInterface
{
    /**
     * @param string $filePath
     * @return array
     */
    public function getFileContents(string $filePath): array
    {
        $data = [];
        if (($fileHandler = fopen(storage_path('app/' . $filePath), "r")) !== false) {
            fgets($fileHandler);
            while (($line = fgetcsv($fileHandler)) !== false) {
                if (array(null) !== $line) {
                    $data[] = $line;
                }
            }
            fclose($fileHandler);

            return $data;
        }

        throw new Exception("File Not Found");
    }
}
