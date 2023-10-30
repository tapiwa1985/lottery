<?php

namespace App\FileUtils;

use App\FileUtils\Contracts\FileFilterInterface;

class ResultEntryFileFilter implements FileFilterInterface
{
    /**
     * @param array $files
     * @return array
     */
    public function filter(array $files): array
    {
        return array_filter($files, function ($file) {
            return strpos($file, "result.csv") !== false;
        });
    }
}
