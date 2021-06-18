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
        $validRepository = (new Repository())->withPath(storage_path('app/tests/fixtures/git/empty'));

        $this->assertTrue($validRepository->exists());
    }

    /** @test */
    public function the_exists_method_returns_false_when_the_repository_does_not_exist()
    {
        $validRepository = (new Repository())->withPath(storage_path('app/tests/fixtures/git/does_not_exist'));

        $this->assertFalse($validRepository->exists());
    }

    /** @test */
    public function it_can_get_the_total_commits_for_an_empty_repository()
    {
        $emptyRepository = (new Repository())->withPath(storage_path('app/tests/fixtures/git/does_not_exist'));

        $this->assertEquals(0, $emptyRepository->totalCommits());
    }
}
