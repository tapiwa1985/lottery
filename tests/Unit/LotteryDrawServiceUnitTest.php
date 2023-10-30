<?php

namespace Tests\Unit;

use App\FileProcessors\Contracts\FileReaderInterface;
use App\Services\Contracts\LotteryDrawServiceInterface;
use Illuminate\Support\Collection;
use Tests\TestCase;

class LotteryDrawServiceUnitTest extends TestCase
{
    private $files = [
        'uploads/germany_03-11-2019_32322.csv',
    ];
    /**
     * @return void
     */
    public function test_it_can_create_lottery_draws_from_files(): void
    {
        $this->mock(FileReaderInterface::class, function ($mock) {
            $mock->shouldReceive('getFileContents')
                ->once()
                ->with('uploads/germany_03-11-2019_32322.csv')
                ->andReturn(
                    [
                        ['31;1:4:5:30:45;2;'],
                        ['32;1:4:5:30:45;2;'],
                    ]
                );
        });
        $result = app(LotteryDrawServiceInterface::class)->createLotteryDraws($this->files);
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(1, $result);
        $this->assertEquals('germany', $result->get(0)->getCountryName());
        $this->assertEquals('03-11-2019', $result->get(0)->getDrawDate());
        $this->assertEquals('32322', $result->get(0)->getDrawNumber());
    }

    /**
     * @return void
     */
    public function test_lottery_tickets_are_added_to_draw(): void 
    {
        $this->mock(FileReaderInterface::class, function ($mock) {
            $mock->shouldReceive('getFileContents')
                ->once()
                ->with('uploads/germany_03-11-2019_32322.csv')
                ->andReturn(
                    [
                        ['31;1:4:5:30:45;2;'],
                        ['32;1:4:5:30:45;2;'],
                    ]
                );
        });
        $result = app(LotteryDrawServiceInterface::class)->createLotteryDraws($this->files);
        $this->assertEquals(2, $result->get(0)->getLotteryTickets()->count());
        $firstTicket = $result->get(0)->getLotteryTickets()->get(0);
        $secondTicket = $result->get(0)->getLotteryTickets()->get(1);
        $this->assertEquals('31', $firstTicket->getLotteryTicketId()); 
        $this->assertEquals('32', $secondTicket->getLotteryTicketId()); 
    }
}
