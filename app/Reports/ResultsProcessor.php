<?php

namespace App\Reports;

use App\Classes\Domain\ResultEntry;
use App\Reports\Contracts\ReportGeneratorInterface;
use App\Reports\Contracts\ResultsProcessorInterface;
use Illuminate\Support\Collection;
use App\Reports\ReportEntry;

class ResultsProcessor implements ResultsProcessorInterface
{
    /**
     * @var ReportGeneratorInterface
     */
    private ReportGeneratorInterface $reportGenerator;

    /**
     * @param ReportGeneratorInterface $reportGenerator
     */
    public function __construct(ReportGeneratorInterface $reportGenerator)
    {
        $this->reportGenerator = $reportGenerator;
    }

    /**
     * @param Collection $resultEntries
     * @return void
     */
    public function processResults(Collection $resultEntries): void
    {
        foreach ($resultEntries as $resultEntry) {
            $reportEntries = $this->processResultEntry($resultEntry);
            $this->reportGenerator->generate($reportEntries);
        }
    }

    /**
     * @param ResultEntry $resultEntry
     * @return array
     */
    private function processResultEntry(ResultEntry $resultEntry): array
    {
        $jackpot = $resultEntry->getLotteryDraw();
        $lotteryTickets = $jackpot->getLotteryTickets();
        $reportEntries = [];
        foreach ($lotteryTickets as $lotteryTicket) {
            $reportEntry = new ReportEntry($lotteryTicket, $resultEntry);
            $reportEntries[] = $reportEntry->toArray();
        }

        return $reportEntries;
    }
}
