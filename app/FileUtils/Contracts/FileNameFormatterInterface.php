<?php

namespace App\FileUtils\Contracts;

interface FileNameFormatterInterface
{
     /**
     * @param string $fileName
     * @return string
     */
    public function formatFileName(string $fileName): string;
}
