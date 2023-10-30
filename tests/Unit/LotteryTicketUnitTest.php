<?php

namespace Tests\Unit;

use App\Classes\Domain\LotteryDraw;
use App\Classes\Domain\LotteryEntity;
use App\Classes\Domain\LotteryTicket;
use Illuminate\Support\Collection;
use Tests\TestCase;

class LotteryTicketUnitTest extends TestCase
{
    private LotteryTicket $lotteryTicket;

    private Collection $mainBallSet;

    private Collection $bonusBallSet;

    private LotteryDraw $lotteryDraw;

    private LotteryEntity $lotteryEntity;

    public function setUp(): void
    {
        parent::setUp();
        $this->lotteryDraw = new LotteryDraw('12-12-2020', 'Germany', 12);
        $this->mainBallSet = collect([1, 6, 14, 28, 45]);
        $this->bonusBallSet = collect([1,6]);
        $this->lotteryEntity = new LotteryEntity($this->mainBallSet, $this->bonusBallSet);
        $this->lotteryTicket = new LotteryTicket('120', $this->lotteryEntity);
    }

    public function test_can_get_main_ball_set(): void
    {
        $this->assertEquals(5, $this->lotteryTicket->getLotteryEntity()->getMainBallSet()->count());
        $this->assertInstanceOf(Collection::class, $this->lotteryTicket->getLotteryEntity()->getMainBallSet());
    }

    public function test_can_get_bonus_set(): void
    {
        $this->assertEquals(2, $this->lotteryTicket->getLotteryEntity()->getBonusBallSet()->count());
        $this->assertInstanceOf(Collection::class, $this->lotteryTicket->getLotteryEntity()->getBonusBallSet());
    }

    public function test_can_get_ticket_id(): void   
    {
        $this->assertEquals(120, $this->lotteryTicket->getLotteryTicketId());
    }

    public function test_can_get_ticket_winning_status(): void   
    {
        $this->assertEquals(false, $this->lotteryTicket->hasWon());
    }

    public function test_can_set_ticket_winning_status(): void
    {
        $this->lotteryTicket->setHasWon(true);
        $this->assertEquals(true, $this->lotteryTicket->hasWon());
    }
}
