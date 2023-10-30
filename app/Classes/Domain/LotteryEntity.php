<?php

namespace App\Classes\Domain;

use Illuminate\Support\Collection;

class LotteryEntity
{
    /**
     * @var Collection
     */
    private Collection $mainBallSet;

    /**
     * @var Collection
     */
    private Collection $bonusBallSet;

    /**
     * @param Collection $mainBallSet
     * @param Collection $bonusBallSet
     */
    public function __construct(
        Collection $mainBallSet,
        Collection $bonusBallSet
    ) {
        $this->mainBallSet = $mainBallSet;
        $this->bonusBallSet = $bonusBallSet;
    }

    /**
     * @return Collection
     */
    public function getMainBallSet(): Collection
    {
        return $this->mainBallSet;
    }

    /**
     * @return Collection
     */
    public function getBonusBallSet(): Collection
    {
        return $this->bonusBallSet;
    }
}
