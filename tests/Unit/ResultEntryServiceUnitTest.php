<?php

namespace Tests\Unit;

use App\Classes\Domain\LotteryDraw;
use App\FileProcessors\Contracts\FileReaderInterface;
use App\Services\Contracts\ResultEntryServiceInterface;
use Tests\TestCase;

class ResultEntryServiceUnitTest extends TestCase
{
    public function test_it_creates_result_entries(): void
    {
        $drawDate = '03-11-2019';
        $country = 'germany';
        $drawNumber = '32322';
        $lotteryDraw = new LotteryDraw($drawDate, $country, $drawNumber);
        $files = [
            'uploads/germany_03-11-2019_32322. result.csv',
        ];
        $this->mock(FileReaderInterface::class, function ($mock) {
            $mock->shouldReceive('getFileContents')
                ->once()
                ->with('uploads/germany_03-11-2019_32322. result.csv')
                ->andReturn(
                    [
                        ['1:45:78:9:56;'],
                        ['7;6;']
                    ]);
        });
        app(ResultEntryServiceInterface::class)->createResultEntries($files, collect([$lotteryDraw]));
    }
}
