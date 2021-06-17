<?php

namespace App\Contracts;

interface Metric
{
    public function getKey(): string;

    /**
     * Returns the value of the metric
     *
     * @return int
     */
    public function getValue();
}
