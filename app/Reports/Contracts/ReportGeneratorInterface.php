<?php

namespace App\Reports\Contracts;

interface ReportGeneratorInterface
{
    /**
     * @param array $report
     * @return void
     */
    public function generate(array $report): void;
}
