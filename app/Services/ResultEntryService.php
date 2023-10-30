<?php

namespace App\Services;

use App\Classes\Domain\LotteryDraw;
use App\Classes\Domain\LotteryEntity;
use App\Classes\Domain\ResultEntry;
use App\Classes\ResultFile;
use App\Exceptions\LotteryDrawNotFoundException;
use App\FileProcessors\Contracts\FileReaderInterface;
use App\FileUtils\Contracts\FileNameFormatterInterface;
use App\FileUtils\Contracts\ResultEntryFileParserInterface;
use App\Services\Contracts\ResultEntryServiceInterface;
use Illuminate\Support\Collection;

class ResultEntryService implements ResultEntryServiceInterface
{
    /**
     * @var FileReaderInterface
     */
    private FileReaderInterface $fileReader;

    /**
     * @var FileNameFormatterInterface
     */
    private FileNameFormatterInterface $fileNameFormatter;

    /**
     * @var ResultEntryFileParserInterface
     */
    private ResultEntryFileParserInterface $fileParser;

    /**
     * @param FileReaderInterface $fileReader
     * @param FileNameFormatterInterface $fileNameFormatter
     * @param ResultEntryFileParserInterface $fileParser
     */
    public function __construct(FileReaderInterface $fileReader, FileNameFormatterInterface $fileNameFormatter, ResultEntryFileParserInterface $fileParser)
    {
        $this->fileReader = $fileReader;
        $this->fileNameFormatter = $fileNameFormatter;
        $this->fileParser = $fileParser;
    }

    /**
     * @param array $resultEntryFiles
     * @return void
     * @throws LotteryDrawNotFoundException
     */
    public function createResultEntries(
        array $resultEntryFiles,
        Collection $lotteryDraws
    ): Collection {
        $resultEntries = collect();
        foreach ($resultEntryFiles as $resultEntryFileName) {
            $resultEntryLine = $this->fileReader->getFileContents(
                $resultEntryFileName
            );
            $this->fileParser->setLineEntry($resultEntryLine);
            $lotteryDraw = $this->getLotteryDraw(
                $resultEntryFileName,
                $lotteryDraws
            );
            $lotteryDraw == null ? throw new LotteryDrawNotFoundException() : '';
            $resultEntry = $this->createResultEntry($lotteryDraw);
            $resultEntries->push($resultEntry);
        }

        return $resultEntries;
    }

    /**
     * @param string $resultEntryFileName
     * @param Collection $lotteryDraws
     * @return LotteryDraw
     */
    private function getLotteryDraw(
        string $resultEntryFileName,
        Collection $lotteryDraws
    ): LotteryDraw {
        $resultEntryFile = $this->createResulEntryFile($resultEntryFileName);
        return $lotteryDraws
            ->filter(function ($lotteryDraw) use ($resultEntryFile) {
                return $lotteryDraw->getDrawNumber() ==
                    $resultEntryFile->getDrawNumber() &&
                    $lotteryDraw->getCountryName() == $resultEntryFile->getCountry();
            })
            ->first();
    }

    /**
     * @param array $resultEntryLineParts
     * @return ResultEntry
     */
    private function createResultEntry(
        LotteryDraw $lotteryDraw
    ): ResultEntry {
        $mainBallSet = collect($this->fileParser->getMainBallSet());
        $bonusBallSet = collect($this->fileParser->getBonusBallSet());
        $lotteryEntity = new LotteryEntity($mainBallSet, $bonusBallSet);

        return new ResultEntry($lotteryEntity, $lotteryDraw);
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function createResulEntryFile(string $fileName): ResultFile
    {
        $foramttedFileName = $this->fileNameFormatter->formatFileName($fileName);

        return new ResultFile($foramttedFileName);
    }
}
