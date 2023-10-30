<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;

interface LotteryTicketServiceInterface
{
    /**
     * @param array $lineEntries
     * @return Collection
     */
    public function createLotteryTickets(array $lineEntries): Collection;
}
