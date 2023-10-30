<?php

namespace App\Providers;

use App\FileProcessors\Contracts\FileReaderInterface;
use App\FileProcessors\Contracts\FileWriterInterface;
use App\FileProcessors\Contracts\SftpScannerInterface;
use App\FileProcessors\FileReader;
use App\FileProcessors\FileWriter;
use App\FileProcessors\SftpScanner;
use App\FileUtils\Contracts\DrawFileParserInterface;
use App\FileUtils\Contracts\FileNameFormatterInterface;
use App\FileUtils\Contracts\ResultEntryFileParserInterface;
use App\FileUtils\DrawFileParser;
use App\FileUtils\FileNameFormatter;
use App\FileUtils\ResultEntryFileParser;
use App\Reports\Contracts\ResultsProcessorInterface;
use App\Reports\ReportGenerator;
use App\Reports\Contracts\ReportGeneratorInterface;
use App\Reports\ResultsProcessor;
use App\Services\Contracts\LotteryDrawServiceInterface;
use App\Services\Contracts\LotteryTicketServiceInterface;
use App\Services\Contracts\ResultEntryServiceInterface;
use App\Services\LotteryDrawService;
use App\Services\LotteryTicketService;
use App\Services\ResultEntryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SftpScannerInterface::class, SftpScanner::class);
        $this->app->bind(FileReaderInterface::class, FileReader::class);
        $this->app->bind(LotteryDrawServiceInterface::class, LotteryDrawService::class);
        $this->app->bind(LotteryTicketServiceInterface::class, LotteryTicketService::class);
        $this->app->bind(ResultEntryServiceInterface::class, ResultEntryService::class);
        $this->app->bind(ReportGeneratorInterface::class, ReportGenerator::class);
        $this->app->bind(FileWriterInterface::class, FileWriter::class);
        $this->app->bind(ResultsProcessorInterface::class, ResultsProcessor::class);
        $this->app->bind(FileNameFormatterInterface::class, FileNameFormatter::class);
        $this->app->bind(DrawFileParserInterface::class, DrawFileParser::class);
        $this->app->bind(ResultEntryFileParserInterface::class, ResultEntryFileParser::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
