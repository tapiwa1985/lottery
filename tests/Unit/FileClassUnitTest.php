<?php

namespace Tests\Unit;

use App\Classes\File;
use App\Classes\LottoDrawFile;
use App\Classes\ResultFile;
use Tests\TestCase;

class FileClassUnitTest extends TestCase
{
    private File $file;

    public function setUp(): void
    {
        parent::setUp();
        $fileName = 'germany_04-12-2020_3778.csv';
        $this->file = new File($fileName);
    }

    public function test_can_fetch_country_name_from_file(): void 
    {
        $this->assertEquals('germany', $this->file->getCountry());
    }

    public function test_can_fetch_draw_date_from_file(): void
    {
        $this->assertEquals('04-12-2020', $this->file->getDrawDate());
    }

    public function test_can_get_draw_number_from_lottery_draw_file(): void
    {
        $fileName = 'germany_04-12-2020_3778.csv';
        $drawFile = new LottoDrawFile($fileName);
        $this->assertEquals('3778', $drawFile->getDrawNumber());
    }

    public function test_can_get_draw_number_from_resul_file(): void
    {
        $fileName = 'germany_04-12-2020_3779 result.csv';
        $drawFile = new ResultFile($fileName);
        $this->assertEquals('3779', $drawFile->getDrawNumber());
    }
}
