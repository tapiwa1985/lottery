<?php

namespace Tests\Unit;

use App\FileProcessors\Contracts\SftpScannerInterface;
use Tests\TestCase;

class SftpScannerUnitTest extends TestCase
{
    private SftpScannerInterface $scanner;

    public function setUp(): void
    {
        parent::setUp();
        $this->scanner = app()->make(SftpScannerInterface::class);
    }

    public function test_it_returns_list_of_files_in_directory()
    {
        $result = $this->scanner->scanDirectory('uploads');
        $this->assertEquals(6, count($result));
        $this->assertContains('uploads/germany_03-11-2019_32322 result.csv', $result);
        $this->assertContains('uploads/germany_03-11-2019_32322.csv', $result);
        $this->assertContains('uploads/italy_03-11-2019_32322 result.csv', $result);
        $this->assertContains('uploads/italy_03-11-2019_32322.csv', $result);
    }
}
