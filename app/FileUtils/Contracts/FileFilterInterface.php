<?php

namespace App\FileUtils\Contracts;

interface FileFilterInterface
{
    /**
     * @param array $files
     */
    public function filter(array $files): array;
}
