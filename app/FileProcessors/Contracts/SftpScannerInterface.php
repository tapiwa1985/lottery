<?php

namespace App\FileProcessors\Contracts;

interface SftpScannerInterface
{
    /**
     * @param string $directory
     * @return array
     */
    public function scanDirectory(string $directory): array;
}
