<?php

namespace Tests\Unit;

use App\FileUtils\ResultEntryFileFilter;
use Tests\TestCase;

class ResultEntryFileFilterUnitTest extends TestCase
{
    
    private array $files;

    public function setUp(): void
    {
        parent::setUp();
        $this->files = ['norway_07-11-2020_332.csv', 
        'italy_07-11-2020_332.csv',
        'norway_07-11-2020_332.csv result.csv'];
    }

    public function test_it_can_filter_result_entry_files(): void
    {
        $lotteryDrawFileFilter = new ResultEntryFileFilter();
        $result = $lotteryDrawFileFilter->filter($this->files);
        $this->assertEquals(1, count($result));
        $this->assertContains('norway_07-11-2020_332.csv result.csv', $result);
    }
}
