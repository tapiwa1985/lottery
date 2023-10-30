<?php

namespace App\Classes\Domain;

use Illuminate\Support\Collection;

class LotteryDraw
{
    /**
     * @var string $drawDate
     */
    private string $drawDate;

    /**
     * @var string $countryName
     */
    private string $countryName;

    /**
     * @var string $drawNumber
     */
    private string $drawNumber;

    /**
     * @var Collection
     */
    private Collection $lotteryTickets;

    /**
     * @param string $drawDate
     * @param string $countryName
     * @param string $drawNumber
     */
    public function __construct(
        string $drawDate,
        string $countryName,
        string $drawNumber
    ) {
        $this->drawDate = $drawDate;
        $this->countryName = $countryName;
        $this->drawNumber = $drawNumber;
        $this->lotteryTickets = new Collection();
    }

    /**
     * @return string
     */
    public function getDrawDate(): string
    {
        return $this->drawDate;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function getDrawNumber(): string
    {
        return $this->drawNumber;
    }

    /**
     * @param Collection $lotteryTickets
     * @return void
     */
    public function setLotteryTickets(Collection $lotteryTickets): void
    {
        $this->lotteryTickets = $lotteryTickets;
    }

    /**
     * @return Collection
     */
    public function getLotteryTickets(): Collection
    {
        return $this->lotteryTickets;
    }
}
