<?php

namespace Tests\Unit;

use App\FileProcessors\Contracts\FileReaderInterface;
use Tests\TestCase;

class FileReaderUnitTest extends TestCase
{
    /**
     * @return void
     */
    public function test_it_can_read_data_from_file(): void
    {
        $filePath = 'test/testData.csv';
        $fileReader = app()->make(FileReaderInterface::class);
        $expectedData = [
            ['11;1:4:5:30:45;2;']
        ];
        $result = $fileReader->getFileContents($filePath);
        $this->assertEquals($expectedData, $result);
    }
}
