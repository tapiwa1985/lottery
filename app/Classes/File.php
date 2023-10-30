<?php

namespace App\Classes;

class File
{
    /**
     * @var string
     */
    protected string $fileName;

    /**
     * @var array
     */
    protected array $fileParts;

    /**
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->fileParts = explode('_', $this->fileName);
    }

    /**
     * @return string
     */
    public function getDrawDate(): string
    {
        return $this->fileParts[1];
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->fileParts[0];
    }
}
