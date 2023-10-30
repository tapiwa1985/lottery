<?php

namespace App\Classes\Domain;

class LotteryTicket
{
    /**
     * @var string
     */
    private string $lotteryTicketId;

    /**
     * @var LotteryEntity
     */
    private LotteryEntity $lotteryEntity;

    /**
     * @var bool
     */
    private bool $hasWon;

    /**
     * @param string $lotteryTicketId
     * @param LotteryEntity $lotteryEntity
     */
    public function __construct(string $lotteryTicketId, LotteryEntity $lotteryEntity)
    {
        $this->lotteryTicketId = $lotteryTicketId;
        $this->lotteryEntity = $lotteryEntity;
        $this->hasWon = false;
    }

    /**
     * @return string
     */
    public function getLotteryTicketId(): string
    {
        return $this->lotteryTicketId;
    }

    /**
     * @return LotteryEntity
     */
    public function getLotteryEntity(): LotteryEntity
    {
        return $this->lotteryEntity;
    }

    /**
     * @param bool $hasWon
     * @return void
     */
    public function setHasWon(bool $hasWon): void
    {
        $this->hasWon = $hasWon;
    }

    /**
     * @return bool
     */
    public function hasWon(): bool
    {
        return $this->hasWon;
    }
}
