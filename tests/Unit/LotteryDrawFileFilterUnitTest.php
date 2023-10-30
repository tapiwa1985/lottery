<?php

namespace Tests\Unit;

use App\FileUtils\LotteryDrawFileFilter;
use Tests\TestCase;

class LotteryDrawFileFilterUnitTest extends TestCase
{
    private array $files;

    public function setUp(): void
    {
        parent::setUp();
        $this->files = [
            'norway_07-11-2020_332.csv', 
            'italy_07-11-2020_332.csv',
            'norway_07-11-2020_332.csv result.csv'
        ];
    }

    public function test_it_can_filter_lottory_draw_files(): void
    {
        $lotteryDrawFileFilter = new LotteryDrawFileFilter();
        $result = $lotteryDrawFileFilter->filter($this->files);
        $this->assertEquals(2, count($result));
        $this->assertContains('norway_07-11-2020_332.csv', $result);
        $this->assertContains('italy_07-11-2020_332.csv', $result);
    }
}
