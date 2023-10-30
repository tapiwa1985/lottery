<?php

namespace App\FileProcessors;

use App\FileProcessors\Contracts\SftpScannerInterface;
use Illuminate\Support\Facades\Storage;

class SftpScanner implements SftpScannerInterface
{
    /**
     * @param string $directory
     * @return array
     */
    public function scanDirectory(string $directory): array
    {
        $files = Storage::files($directory);

        return $files;
    }
}
