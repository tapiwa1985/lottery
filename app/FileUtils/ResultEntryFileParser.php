<?php

namespace App\FileUtils;

use App\FileUtils\Contracts\ResultEntryFileParserInterface;

class ResultEntryFileParser implements ResultEntryFileParserInterface
{
    /**
     * @var string
     */
    private string $lineEtry;

    /**
     * @var array
     */
    private array $lineParts = [];

    /**
     * @return array
     */
    public function getMainBallSet(): array
    {
        return explode(":", $this->lineParts[0]);
    }

    /**
     * @return array
     */
    public function getBonusBallSet(): array
    {
        return explode(":", $this->lineParts[1]);
    }

    /**
     * @param array
     * @return void
     */
    public function setLineEntry(array $lineEtry): void
    {
        $this->lineParts = explode(";", $lineEtry[0][0]);
    }
}
