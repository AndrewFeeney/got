<?php

namespace Tests\Unit\Services\Git;

use App\Contracts\AnalysisResult;
use App\Services\Analysis\Analyses\TotalFiles;
use App\Services\Git\Repository;
use Tests\TestCase as TestsTestCase;

class RepositoryTest extends TestsTestCase
{
    /** @test */
    public function it_can_analyse_a_commit()
    {
        $repository = new Repository(base_path('tests/fixtures/git/simple'));

        $analysis = new TotalFiles;

        $result = $repository->analyse($analysis);

        $this->assertInstanceOf(AnalysisResult::class, $result);
    }
}
