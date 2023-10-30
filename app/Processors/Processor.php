<?php

namespace App\Processors;

use App\FileProcessors\Contracts\FileReaderInterface;
use App\FileProcessors\Contracts\SftpScannerInterface;
use App\FileUtils\LotteryDrawFileFilter;
use App\FileUtils\ResultEntryFileFilter;
use App\Reports\Contracts\ResultsProcessorInterface;
use App\Reports\ResultsProcessor;
use App\Services\Contracts\LotteryDrawServiceInterface;
use App\Services\Contracts\LotteryTicketServiceInterface;
use App\Services\Contracts\ResultEntryServiceInterface;
use Illuminate\Support\Collection;

class Processor
{
    /**
     * @var SftpScannerInterface
     */
    private SftpScannerInterface $scanner;

    /**
     * @var FileReaderInterface
     */
    private FileReaderInterface $fileReader;

    /**
     * @var LotteryDrawServiceInterface
     */
    private LotteryDrawServiceInterface $lotteryDrawService;

    /**
     * @var LotteryTicketServiceInterface
     */
    private LotteryTicketServiceInterface $lotteryTicketService;

    /**
     * @var ResultEntryServiceInterface
     */
    private ResultEntryServiceInterface $resultEntryService;

    /**
     * @var Collection
     */
    private Collection $lotteryDraws;

    /**
     * @var Collection
     */
    private Collection $results;

    /**
     * @var ResultsProcessor
     */
    private ResultsProcessorInterface $resultsProcessor;

    private ResultEntryFileFilter $resultEntryFileFilter;

    private LotteryDrawFileFilter $lotteryDrawFileFilter;

    public function __construct(
        SftpScannerInterface $scanner,
        FileReaderInterface $fileReader,
        LotteryDrawServiceInterface $lotteryDrawService,
        LotteryTicketServiceInterface $lotteryTicketService,
        ResultEntryServiceInterface $resultEntryService,
        ResultsProcessor $resultsProcessor,
        LotteryDrawFileFilter $lotteryDrawFileFilter,
        ResultEntryFileFilter $resultEntryFileFilter
    ) {
        $this->scanner = $scanner;
        $this->fileReader = $fileReader;
        $this->lotteryDrawService = $lotteryDrawService;
        $this->lotteryTicketService = $lotteryTicketService;
        $this->resultEntryService = $resultEntryService;
        $this->resultsProcessor = $resultsProcessor;
        $this->resultEntryFileFilter = $resultEntryFileFilter;
        $this->lotteryDrawFileFilter = $lotteryDrawFileFilter;
        $this->lotteryDraws = new Collection();
        $this->results = new Collection();
    }

    public function run(): void
    {
        $uploadedFiles = $this->scanner->scanDirectory('uploads');
        $lotteryDrawFiles = $this->lotteryDrawFileFilter->filter($uploadedFiles);
        $resultEntryFiles = $this->resultEntryFileFilter->filter(
            $uploadedFiles
        );
        $this->lotteryDraws = $this->lotteryDrawService->createLotteryDraws(
            $lotteryDrawFiles
        );
        $this->results = $this->resultEntryService->createResultEntries(
            $resultEntryFiles,
            $this->lotteryDraws
        );
        $this->resultsProcessor->processResults($this->results);
    }
}
