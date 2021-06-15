<?php

namespace App\Contracts;

interface Metric
{
    public function getKey(): string;
    public function getValue();
}
