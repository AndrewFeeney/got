<?php

namespace Tests\Unit\Services\Git;

use App\Contracts\AnalysisResult;
use App\Services\Analysis\Analyses\TotalFiles;
use App\Services\Git\Repository;
use Tests\TestCase as TestsTestCase;

class RepositoryTest extends TestsTestCase
{
    /** @test */
    public function it_accepts_a_path_to_a_git_repository_on_disk()
    {
        $repository = (new Repository())->withPath($path = base_path('tests/fixtures/git/empty'));

        $this->assertEquals($path, $repository->getPath());
    }

    /** @test */
    public function the_exists_method_returns_true_when_the_repository_exists()
    {
        $validRepository = (new Repository())->withPath($path = base_path('tests/fixtures/git/empty'));

        $this->assertTrue($validRepository->exists());
    }

    /** @test */
    public function it_can_analyse_a_commit()
    {
        $repository = new Repository(base_path('tests/fixtures/git/empty'));

        $analysis = new TotalFiles;

        $result = $repository->analyse($analysis);

        $this->assertInstanceOf(AnalysisResult::class, $result);
        $this->assertEquals(0, $result->getMetric(TotalFiles::METRIC_TOTAL_FILES)->getValue());
    }
}
