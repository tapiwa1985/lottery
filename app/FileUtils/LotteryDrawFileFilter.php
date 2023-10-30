<?php

namespace App\FileUtils;

use App\FileUtils\Contracts\FileFilterInterface;

class LotteryDrawFileFilter implements FileFilterInterface
{
    /**
     * @param array $files
     * @return array
     */
    public function filter(array $files): array
    {
        return array_filter($files, function ($file) {
            return !preg_match('/result/', $file);
        });
    }
}
