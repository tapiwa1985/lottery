<?php

namespace Tests\Unit;

use App\FileProcessors\Contracts\FileWriterInterface;
use App\Reports\Contracts\ReportGeneratorInterface;
use Faker\Factory;
use Tests\TestCase;

class ReportGeneratorUnitTest extends TestCase
{
    public function test_genarate_report_assert_file_writter_is_invoked(): void
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
        $resultSet = [
            [1, 6, 2, 12223, 'Italy', '20-12-2000', 'YES'],
            [2, 6, 2, 12223, 'Italy', '20-12-2000', 'YES']
        ];
        $reportFilePath = storage_path('app/test.csv');
        $this->mock(FileWriterInterface::class, function ($mock)  {
            $mock->shouldReceive('writeToFile')
                ->once();
        });
        app(ReportGeneratorInterface::class)->generate($resultSet);
    }
}
