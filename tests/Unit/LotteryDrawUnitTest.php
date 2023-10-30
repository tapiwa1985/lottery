<?php

namespace Tests\Unit;

use App\Classes\Domain\LotteryDraw;
use App\Classes\Domain\LotteryEntity;
use App\Classes\Domain\LotteryTicket;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Collection;
use Tests\TestCase;

class LotteryDrawUnitTest extends TestCase
{
    private LotteryDraw $lotteryDraw;

    private string $drawDate;

    private string $country;

    private string $drawNumber;

    private Collection $lotteryTickets;

    private Generator $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();   
        $this->drawDate = '03-11-2020';
        $this->country = 'Germany';
        $this->drawNumber = '22445';
        $this->lotteryDraw = new LotteryDraw($this->drawDate, $this->country, $this->drawNumber);
        $this->lotteryTickets = collect();
        $this->createLotteryTickets();
    }

    private function createLotteryTickets()
    {
        $ticketId = rand(1,3000);
        $mainBallSet = collect(['20','12','4', '38']);
        $bonusBall = collect(['5']);
        $lotteryEntry = new LotteryEntity($mainBallSet, $bonusBall);
        $lotteryTicket = new LotteryTicket($ticketId, $lotteryEntry);
        $this->lotteryTickets->push($lotteryTicket);
    }

    public function test_can_return_lottery_draw_date():void 
    {
        $this->assertEquals($this->drawDate, $this->lotteryDraw->getDrawDate());
    }

    public function test_can_return_country_name(): void 
    {
        $this->assertEquals($this->country, $this->lotteryDraw->getCountryName());
    }

    public function test_can_return_draw_number():void
    {
        $this->assertEquals($this->drawNumber, $this->lotteryDraw->getdrawNumber());
    }

    public function test_can_set_lottery_tickets():void
    {
        $this->lotteryDraw->setLotteryTickets($this->lotteryTickets);
        $result = $this->lotteryDraw->getlotteryTickets();
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(1, $result->count());
    }
}
