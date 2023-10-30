<?php

namespace App\FileUtils\Contracts;

interface DrawFileParserInterface extends FileParserInterface
{
    /**
     * @return string
     */
    public function getTicketId(): string;
}
