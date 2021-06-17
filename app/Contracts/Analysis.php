<?php

namespace App\Contracts;

interface Analysis
{
    public function analyseCommit(Commit $commit): AnalysisResult;
}
