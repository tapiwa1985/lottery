<?php

namespace Tests\Unit;

use App\FileProcessors\Contracts\FileWriterInterface;
use Tests\TestCase;

class FileWriterUnitTest extends TestCase
{
    public function test_it_can_write_data_to_file(): void
    {
        $filePath = storage_path('app/test/testOutputFile.csv');
        $fileWritter = app()->make(FileWriterInterface::class);
        $data = [
            ['11;1:4:5:30:45;2;']
        ];
        $fileWritter->writeToFile($filePath, $data, []);
        $fileContents = file_get_contents($filePath);
        $this->assertEquals('11;1:4:5:30:45;2;', trim($fileContents));
    }
}
