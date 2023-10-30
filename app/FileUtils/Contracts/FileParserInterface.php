<?php

namespace App\FileUtils\Contracts;

interface FileParserInterface
{
    /**
     * @return array
     */
    public function getMainBallSet(): array;

    /**
     * @return array
     */
    public function getBonusBallSet(): array;

    /**
     * @param array $lineEntry
     * @return void
     */
    public function setLineEntry(array $lineEntry): void;
}
