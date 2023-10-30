<?php

namespace App\FileProcessors\Contracts;

interface FileWriterInterface
{
    /**
     * @param string $filePath
     * @param array $data
     * @param array $headers
     * @return void
     */
    public function writeToFile(string $filePath, array $data, array $headers): void;
}
