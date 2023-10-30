<?php

namespace Tests\Unit;

use App\Services\Contracts\LotteryTicketServiceInterface;
use Illuminate\Support\Collection;
use Tests\TestCase;

class LotteryTicketServiceUnitTest extends TestCase
{
    /**
     * @return void
     */
    public function test_it_can_create_lottery_tickets_from_line_entries(): void
    {
        $lineEntries = [
            ['31;1:4:5:30:45;2;'],
            ['32;1:4:5:30:45;2;'],
        ];
        $result = app(LotteryTicketServiceInterface::class)->createLotteryTickets($lineEntries);
        $this->assertEquals(2, $result->count());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function test_it_can_sets_the_main_ball_entry_correctly(): void  
    {
        $lineEntries = [
            ['31;1:4:5:30:45;2;'],
        ];
        $result = app(LotteryTicketServiceInterface::class)->createLotteryTickets($lineEntries);
        $ticket = $result->first();
        $this->assertEquals(collect([1,4,5,30,45]), $ticket->getLotteryEntity()->getMainBallSet());
    }

    public function test_it_can_sets_the_bonus_ball_entry_correctly(): void  
    {
        $lineEntries = [
            ['31;1:4:5:30:45;2;'],
        ];
        $result = app(LotteryTicketServiceInterface::class)->createLotteryTickets($lineEntries);
        $ticket = $result->first();
        $this->assertEquals(collect([2]), $ticket->getLotteryEntity()->getBonusBallSet());
    }
}
