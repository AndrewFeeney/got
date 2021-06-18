<?php

namespace App\Services\Git;

use App\Contracts\Analysis;
use App\Contracts\AnalysisResult;
use App\Services\Git\Commit;

class Repository
{
    protected $path;

    public function withPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function analyse(Analysis $analysis): AnalysisResult
    {
        return $analysis->analyseCommit($this->currentCommit());
    }

    public function currentCommit(): Commit
    {
        return new Commit;
    }

    public function exists(): bool
    {
        return is_dir($this->path . '/.git');
    }
}
