<?php

namespace App\Services;

use App\Classes\Domain\LotteryDraw;
use App\Classes\LottoDrawFile;
use App\FileProcessors\Contracts\FileReaderInterface;
use App\FileUtils\Contracts\FileNameFormatterInterface;
use App\Services\Contracts\LotteryDrawServiceInterface;
use App\Services\Contracts\LotteryTicketServiceInterface;
use Illuminate\Support\Collection;

class LotteryDrawService implements LotteryDrawServiceInterface
{
    /**
     * @var FileReaderInterface
     */
    private FileReaderInterface $fileReader;

    /**
     * @var LotteryTicketServiceInterface
     */
    private LotteryTicketServiceInterface $ticketService;

    /**
     * @var Collection
     */
    private Collection $lotteryDraws;

    /**
     * @var FileNameFormatterInterface
     */
    private FileNameFormatterInterface $fileNameFormatter;

    /**
     * @param FileReaderInterface $fileReader
     * @param LotteryTicketServiceInterface $ticketService
     * @param FileNameFormatterInterface $fileNameFormatter
     */
    public function __construct(
        FileReaderInterface $fileReader,
        LotteryTicketServiceInterface $ticketService,
        FileNameFormatterInterface $fileNameFormatter
    ) {
        $this->fileReader = $fileReader;
        $this->ticketService = $ticketService;
        $this->fileNameFormatter = $fileNameFormatter;
        $this->lotteryDraws = new Collection();
    }

    /**
     * @param array $lotteryDrawFiles
     * @return collection
     */
    public function createLotteryDraws(array $lotteryDrawFiles): Collection
    {
        foreach ($lotteryDrawFiles as $lotteryDrawFile) {
            $lotteryDrawFileName = $this->fileNameFormatter->formatFileName($lotteryDrawFile);
            $file = new LottoDrawFile($lotteryDrawFileName);
            $lotteryDraw = $this->createLotteryDraw($file);
            $lotteryTicketLineEntries = $this->fileReader->getFileContents(
                $lotteryDrawFile
            );
            $lotteryTickets = $this->ticketService->createLotteryTickets(
                $lotteryTicketLineEntries
            );
            $this->addLotteryTicketsToJackpot($lotteryDraw, $lotteryTickets);
            $this->lotteryDraws->push($lotteryDraw);
        }

        return $this->lotteryDraws;
    }

    /**
     * @param LottoDrawFile $file
     * @return LotteryDraw
     */
    private function createLotteryDraw(LottoDrawFile $file): LotteryDraw
    {
        $countryName = $file->getCountry();
        $drawNumber = $file->getDrawNumber();
        $drawDate = $file->getDrawDate();

        return new LotteryDraw($drawDate, $countryName, $drawNumber);
    }

    /**
     * @param LotteryDraw $lotteryDraw
     * @param Collection $lotteryTickets
     * @return void
     */
    private function addLotteryTicketsToJackpot(
        LotteryDraw $lotteryDraw,
        Collection $lotteryTickets
    ): void {
        $lotteryDraw->setLotteryTickets($lotteryTickets);
    }
}
