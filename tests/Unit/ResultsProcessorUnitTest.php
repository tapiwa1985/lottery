<?php

namespace Tests\Unit;

use App\Classes\Domain\LotteryDraw;
use App\Classes\Domain\LotteryEntity;
use App\Classes\Domain\LotteryTicket;
use App\Classes\Domain\ResultEntry;
use App\Reports\Contracts\ReportGeneratorInterface;
use App\Reports\Contracts\ResultsProcessorInterface;
use Tests\TestCase;

class ResultsProcessorUnitTest extends TestCase
{
    /**
     * @return void
     */
    public function test_results_processor(): void
    {;
        $lotteryDraw = $this->createLotteryDraw();
        $lotteryEntity = $this->createLotteryEntity();
        $lotteryTicket = new LotteryTicket('120', $lotteryEntity);
        $lotteryDraw->setLotteryTickets(collect([$lotteryTicket]));
        $resultEntry = $this->createResultEntity($lotteryDraw);
        $resultSet = [
            [
                'ticketId' => '120',
                'matchedBallSetCount' => 3,
                'matchedBonusBallSetCount' => 1,
                'drawNumber' => '22445',
                'countryName' => 'Germany',
                'drawDate' => '03-11-2020',
                'hasWon' => 'NO'
            ]
        ];
        $this->mock(ReportGeneratorInterface::class, function ($mock)  use($resultSet){
            $mock->shouldReceive('generate')
                ->once()
                ->with($resultSet);
        });
        app(ResultsProcessorInterface::class)->processResults(collect([$resultEntry]));
    }

    /**
     * @return LotteryDraw
     */
    private function createLotteryDraw(): LotteryDraw 
    {
        $drawDate = '03-11-2020';
        $country = 'Germany';
        $drawNumber = '22445';

        return new LotteryDraw($drawDate, $country, $drawNumber);
    }

    /**
     * @return LotteryEntity
     */
    private function createLotteryEntity(): LotteryEntity 
    {
        $mainBallSet = collect([1,6,14,28,45]);
        $bonusBallSet = collect([1,6]);

        return new LotteryEntity($mainBallSet, $bonusBallSet);
    }

    /**
     * @param LotteryDraw $lotteryDraw
     * @return ResultEntry
     */
    private function createResultEntity(LotteryDraw $lotteryDraw): ResultEntry
    {
        return new ResultEntry((new LotteryEntity(
            collect([1,6,7,15,34,45]),
            collect([2,6]))), $lotteryDraw);
    }
}
