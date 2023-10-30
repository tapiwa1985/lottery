<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;

interface LotteryDrawServiceInterface
{
    /**
     * @param array $lotteryDrawFiles
     * @return collection
     */
    public function createLotteryDraws(array $lotteryDrawFiles): Collection;
}
