<?php

namespace App\Reports;

use App\FileProcessors\Contracts\FileWriterInterface;
use App\Reports\Contracts\ReportGeneratorInterface;
use Illuminate\Support\Str;

class ReportGenerator implements ReportGeneratorInterface
{
    /**
     * @var FileWriterInterface
     */
    private FileWriterInterface $fileWriter;

    /**
     * @param FileWriterInterface $fileWriter
     */
    public function __construct(FileWriterInterface $fileWriter)
    {
        $this->fileWriter = $fileWriter;
    }

    /**
     * @param array $resultSet
     * @return void
     */
    public function generate(array $resultSet): void
    {
        $headers = [
            'Ticket #',
            'Main Ball Set Matches',
            'Bonus Ball Matches',
            'Draw #',
            'Country',
            'Draw Date',
            'Has Won?',
        ];
        $fileName = Str::uuid();
        $reportFilePath = storage_path('app/' . $fileName . '.csv');
        $this->fileWriter->writeToFile($reportFilePath, $resultSet, $headers);
    }
}
