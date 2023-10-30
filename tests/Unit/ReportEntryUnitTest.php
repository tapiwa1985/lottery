<?php

namespace Tests\Unit;

use App\Classes\Domain\LotteryDraw;
use App\Classes\Domain\LotteryEntity;
use App\Classes\Domain\LotteryTicket;
use App\Classes\Domain\ResultEntry;
use App\Reports\ReportEntry;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ReportEntryUnitTest extends TestCase
{
    private LotteryTicket $lotteryTicket;

    private Collection $mainBallSet;

    private Collection $bonusBallSet;

    private LotteryDraw $lotteryDraw;

    private LotteryEntity $lotteryEntity;

    private ResultEntry $resultEntry;

    private ReportEntry $reportEntry;

    public function setUp(): void
    {
        parent::setUp();
        $this->lotteryDraw = new LotteryDraw('12-12-2020', 'Germany', 12);
        $this->mainBallSet = collect([1, 6, 14, 28, 45]);
        $this->bonusBallSet = collect([1,6]);
        $this->resultEntry = new ResultEntry((new LotteryEntity(
            collect([1,6,7,15,34,45]),
            collect([2, 6]))), $this->lotteryDraw);
        $this->lotteryEntity = new LotteryEntity($this->mainBallSet, $this->bonusBallSet);
        $this->lotteryTicket = new LotteryTicket('120', $this->lotteryEntity);
        $this->reportEntry = new ReportEntry($this->lotteryTicket, $this->resultEntry);
    }

    public function test_report_enrty_has_ticket_id(): void 
    {
        $this->assertArrayHasKey('ticketId', $this->reportEntry->toArray());
        $this->assertEquals(120, $this->reportEntry->toArray()['ticketId']);
    }

    public function test_report_entry_has_correct_main_ball_set_cout(): void 
    {
        $this->assertArrayHasKey('matchedBallSetCount', $this->reportEntry->toArray());
        $this->assertEquals(3, $this->reportEntry->toArray()['matchedBallSetCount']);
    }

    public function test_report_entry_has_correct_bonus_ball_set_cout(): void 
    {
        $this->assertArrayHasKey('matchedBonusBallSetCount', $this->reportEntry->toArray());
        $this->assertEquals(1, $this->reportEntry->toArray()['matchedBonusBallSetCount']);
    }

    public function test_report_entry_has_correct_lottery_draw_number(): void 
    {
        $this->assertArrayHasKey('drawNumber', $this->reportEntry->toArray());
        $this->assertEquals(12, $this->reportEntry->toArray()['drawNumber']);
    }

    
    public function test_report_entry_has_correct_country_name(): void 
    {
        $this->assertArrayHasKey('countryName', $this->reportEntry->toArray());
        $this->assertEquals('Germany', $this->reportEntry->toArray()['countryName']);
    }

    public function test_report_entry_has_correct_draw_date(): void 
    {
        $this->assertArrayHasKey('drawDate', $this->reportEntry->toArray());
        $this->assertEquals('12-12-2020', $this->reportEntry->toArray()['drawDate']);
    }

    public function test_report_entry_has_correct_winning_ststus(): void 
    {
        $this->assertArrayHasKey('hasWon', $this->reportEntry->toArray());
        $this->assertEquals('NO', $this->reportEntry->toArray()['hasWon']);
    }
}
