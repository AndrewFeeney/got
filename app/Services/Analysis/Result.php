<?php

namespace App\Services\Analysis;

use App\Contracts\AnalysisResult;
use App\Contracts\Metric;

class Result implements AnalysisResult
{
    protected $metrics = [];

    public function getMetric(string $key): Metric
    {
        return $this->getMetrics()[$key];
    }

    public function getMetrics(): array
    {
        return $this->metrics;
    }

    public function withMetric(Metric $metric): self
    {
        $this->metrics[$metric->getKey()] = $metric;

        return $this;
    }
}
