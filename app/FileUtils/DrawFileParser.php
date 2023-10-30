<?php

namespace App\FileUtils;

use App\FileUtils\Contracts\DrawFileParserInterface;

class DrawFileParser implements DrawFileParserInterface
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
        return explode(":", $this->lineParts[1]);
    }

    /**
     * @return array
     */
    public function getBonusBallSet(): array
    {
        return explode(":", $this->lineParts[2]);
    }

    /**
     * @param array $lineEntry
     * @return void
     */
    public function setLineEntry(array $lineEntry): void
    {
        $this->lineParts = explode(";", $lineEntry[0]);
    }

    /**
     * @return string
     */
    public function getTicketId(): string
    {
        return $this->lineParts[0];
    }
}
