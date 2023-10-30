<?php

namespace App\Services;

use App\Classes\Domain\LotteryEntity;
use App\Classes\Domain\LotteryTicket;
use App\FileUtils\Contracts\DrawFileParserInterface;
use App\Services\Contracts\LotteryTicketServiceInterface;
use Illuminate\Support\Collection;

class LotteryTicketService implements LotteryTicketServiceInterface
{
    /**
     * @var DrawFileParserInterface
     */
    private DrawFileParserInterface $fileParser;

    /**
     * @param DrawFileParserInterface $fileParser
     */
    public function __construct(DrawFileParserInterface $fileParser)
    {
        $this->fileParser = $fileParser;
    }

    /**
     * @param array $lineEntries
     * @return Collection
     */
    public function createLotteryTickets(array $lineEntries): Collection
    {
        $lotteryTickets = collect();
        foreach ($lineEntries as $lineEntry) {
            $this->fileParser->setLineEntry($lineEntry);
            $lotteryTicket = $this->createLotteryTicket();
            $lotteryTickets->push($lotteryTicket);
        }

        return $lotteryTickets;
    }

    /**
     * @param array $lineEntryParts
     * @return LotteryTicket
     */
    private function createLotteryTicket(): LotteryTicket
    {
        $mainBallSetCollection = collect($this->fileParser->getMainBallSet());
        $bonusBallSetCollection = collect($this->fileParser->getBonusBallSet());
        $lotteryEntity = new LotteryEntity($mainBallSetCollection, $bonusBallSetCollection);

        return new LotteryTicket($this->fileParser->getTicketId(), $lotteryEntity);
    }
}
