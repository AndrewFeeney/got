<?php

namespace App\Services\Git;

use App\Contracts\Analysis;
use App\Contracts\AnalysisResult;
use App\Services\Git\Commit;

class Repository
{
    public function analyse(Analysis $analysis): AnalysisResult
    {
        return $analysis->analyseCommit($this->currentCommit());
    }

    public function currentCommit(): Commit
    {
        return new Commit;
    }
}
