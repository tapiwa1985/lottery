<?php

namespace Tests\Unit;

use App\Classes\Domain\LotteryEntity;
use Illuminate\Support\Collection;
use Tests\TestCase;

class LotteryEntityUnitTest extends TestCase
{
    private LotteryEntity $entity;

    private Collection $mainBallSet;

    private Collection $bonusBallSet;

    public function setUp(): void
    {
        parent::setUp();
        $this->mainBallSet = collect([1, 6, 14, 28, 45]);
        $this->bonusBallSet = collect([1,6]);
        $this->entity = new LotteryEntity($this->mainBallSet, $this->bonusBallSet);
    }
    /**
     * A basic unit test example.
     */
    public function test_can_get_main_ball_set(): void
    {
        $this->assertEquals(5, $this->entity->getMainBallSet()->count());
        $this->assertInstanceOf(Collection::class, $this->entity->getMainBallSet());
    }

    public function test_can_get_bonus_set(): void
    {
        $this->assertEquals(2, $this->entity->getBonusBallSet()->count());
        $this->assertInstanceOf(Collection::class, $this->entity->getBonusBallSet());
    }
}
