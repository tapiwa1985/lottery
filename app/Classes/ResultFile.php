<?php

namespace App\Classes;

class ResultFile extends File
{
    /**
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        parent::__construct($fileName);
    }

    /**
     * @return string
     */
    public function getDrawNumber(): string
    {
        return explode(" ", $this->fileParts[2])[0];
    }
}
