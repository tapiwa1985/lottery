<?php

namespace App\Reports;

use App\Classes\Domain\LotteryTicket;
use App\Classes\Domain\ResultEntry;

class ReportEntry
{
    /**
     * @var lotteryTicket
     */
    private LotteryTicket $lotteryTicket;

    /**
     * @var ResultEntry
     */
    private ResultEntry $resultEntry;

    /**
     * @param LotteryTicket $lotteryTicket
     * @param ResultEntry $resultEntry
     */
    public function __construct(
        LotteryTicket $lotteryTicket,
        ResultEntry $resultEntry
    ) {
        $this->lotteryTicket = $lotteryTicket;
        $this->resultEntry = $resultEntry;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $jackpot = $this->resultEntry->getLotteryDraw();

        return [
            'ticketId' => $this->lotteryTicket->getLotteryTicketId(),
            'matchedBallSetCount' => $this->countMatchingMainBallSets(),
            'matchedBonusBallSetCount' => $this->countMatchingBonusBallSet(),
            'drawNumber' => $jackpot->getDrawNumber(),
            'countryName' => $jackpot->getCountryName(),
            'drawDate' => $jackpot->getDrawDate(),
            'hasWon' => $this->hasWon() ? 'YES' : 'NO',
        ];
    }

    /**
     * @return int
     */
    private function countMatchingMainBallSets(): int
    {
        $ticketMainEntries = $this->lotteryTicket
            ->getLotteryEntity()
            ->getMainBallSet();
        $resultMainEntry = $this->resultEntry
            ->getLotteryEntity()
            ->getMainBallSet();

        return $ticketMainEntries->intersect($resultMainEntry)->count();
    }

    /**
     * @return int
     */
    private function countMatchingBonusBallSet(): int
    {
        $ticketBonusEntries = $this->lotteryTicket
            ->getLotteryEntity()
            ->getBonusBallSet();
        $resultBonusEntry = $this->resultEntry
            ->getLotteryEntity()
            ->getBonusBallSet();

        return $ticketBonusEntries->intersect($resultBonusEntry)->count();
    }

    /**
     * @return bool
     */
    private function hasWon(): bool
    {
        $resultEntryLotteryEntity = $this->resultEntry->getLotteryEntity();
        $resultEntryMainBallCount = $resultEntryLotteryEntity
            ->getMainBallSet()
            ->count();
        $matchedMainBallSetCount = $this->countMatchingMainBallSets();
        $matchedBonusBallSetCount = $this->countMatchingBonusBallSet();
        if ($matchedMainBallSetCount == $resultEntryMainBallCount) {
            return true;
        }

        return $matchedMainBallSetCount + $matchedBonusBallSetCount ==
            $resultEntryMainBallCount;
    }
}
