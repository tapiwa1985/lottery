<?php

namespace Tests\Unit;

use App\Classes\Domain\LotteryDraw;
use App\Classes\Domain\LotteryEntity;
use App\Classes\Domain\ResultEntry;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ResultEntryUnitTest extends TestCase
{
    private ResultEntry $resultEntry;

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
        $this->resultEntry = new ResultEntry($this->lotteryEntity, $this->lotteryDraw);
    }

    public function test_can_get_main_ball_set(): void
    {
        $this->assertEquals(5, $this->resultEntry->getLotteryEntity()->getMainBallSet()->count());
        $this->assertInstanceOf(Collection::class, $this->resultEntry->getLotteryEntity()->getMainBallSet());
    }

    public function test_can_get_bonus_set(): void
    {
        $this->assertEquals(2, $this->resultEntry->getLotteryEntity()->getBonusBallSet()->count());
        $this->assertInstanceOf(Collection::class, $this->resultEntry->getLotteryEntity()->getBonusBallSet());
    }

    public function test_can_get_lottery_draw_from_reult_entry(): void
    {
        $this->assertInstanceOf(LotteryDraw::class, $this->resultEntry->getLotteryDraw());
        $this->assertEquals('12-12-2020', $this->resultEntry->getLotteryDraw()->getDrawDate());
        $this->assertEquals('Germany', $this->resultEntry->getLotteryDraw()->getCountryName());
        $this->assertEquals('12', $this->resultEntry->getLotteryDraw()->getDrawNumber());
    }
}
