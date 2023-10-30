<?php

namespace App\Classes\Domain;

class ResultEntry
{
    /**
     * @var LotteryEntity
     */
    private LotteryEntity $lotteryEntity;

    /**
     * @var LotteryDraw
     */
    private LotteryDraw $lotteryDraw;

    /**
     * @param LotteryEntity $lotteryEntity
     * @param LotteryDraw $lotteryDraw
     */
    public function __construct(LotteryEntity $lotteryEntity, LotteryDraw $lotteryDraw)
    {
        $this->lotteryEntity = $lotteryEntity;
        $this->lotteryDraw = $lotteryDraw;
    }

    /**
     * @return LotteryDraw
     */
    public function getLotteryDraw(): LotteryDraw
    {
        return $this->lotteryDraw;
    }

    /**
     * @return LotteryEntity
     */
    public function getLotteryEntity(): LotteryEntity
    {
        return $this->lotteryEntity;
    }
}
