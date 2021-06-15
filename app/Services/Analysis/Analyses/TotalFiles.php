<?php

namespace App\Services\Analysis\Analyses;

use App\Contracts\Analysis;
use App\Contracts\Commit;

use App\Services\Analysis\Result;

class TotalFiles implements Analysis
{
    public function analyseCommit(Commit $commit)
    {
        return new Result();
    }
}
