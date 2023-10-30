<?php

namespace App\FileProcessors\Contracts;

interface FileReaderInterface
{
    /**
     * @param string $filePath
     * @return array
     */
    public function getFileContents(string $filePath): array;
}
