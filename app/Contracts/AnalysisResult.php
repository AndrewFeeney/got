<?php

namespace App\Contracts;

interface AnalysisResult
{
    public function getMetric(string $key): Metric;

    public function getMetrics(): array;
}
