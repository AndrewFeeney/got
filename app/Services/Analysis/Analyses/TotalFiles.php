<?php

namespace App\Services\Analysis\Analyses;

use App\Contracts\Analysis;
use App\Contracts\Commit;
use App\Services\Analysis\Metric;
use App\Services\Analysis\Result;

class TotalFiles implements Analysis
{
    const METRIC_TOTAL_FILES = 'total_files';

    /**
     * @return Result
     */
    public function analyseCommit(Commit $commit)
    {
        return (new Result())
            ->withMetric(new Metric(self::METRIC_TOTAL_FILES, 0));
    }
}
