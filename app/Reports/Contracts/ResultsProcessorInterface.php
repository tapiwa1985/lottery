<?php

namespace App\Reports\Contracts;

use Illuminate\Support\Collection;

interface ResultsProcessorInterface
{
    /**
     * @param Collection
     * @return void
     */
    public function processResults(Collection $results): void;
}
