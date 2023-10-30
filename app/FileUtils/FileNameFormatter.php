<?php

namespace App\FileUtils;

use App\FileUtils\Contracts\FileNameFormatterInterface;

class FileNameFormatter implements FileNameFormatterInterface
{
    /**
     * @param string $fileName
     * @return string
     */
    public function formatFileName(string $fileName): string
    {
        return str_replace("uploads/", "", $fileName);
    }
}
