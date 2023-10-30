<?php

namespace App\FileProcessors;

use App\FileProcessors\Contracts\FileWriterInterface;

class FileWriter implements FileWriterInterface
{
    /**
     * @param string $filePath
     * @param array $content
     * @param array $headers
     * @return void
     */
    public function writeTofile(
        string $filePath,
        array $content,
        array $headers
    ): void {
        header("Content-Type: text/csv");
        $fileHandler = fopen($filePath, "wb");
        fputcsv($fileHandler, $headers);
        foreach ($content as $line) {
            fputcsv($fileHandler, $line);
        }
        fclose($fileHandler);
    }
}
