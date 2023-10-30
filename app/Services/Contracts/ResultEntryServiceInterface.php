<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;

interface ResultEntryServiceInterface
{
    /**
     * @param array $resultEntryFiles
     * @param Collection $lotteryDraws
     * @return Collection
     */
    public function createResultEntries(array $resultEntryFiles, Collection $lotteryDraws): Collection;
}
