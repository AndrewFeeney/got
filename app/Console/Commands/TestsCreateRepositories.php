<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestsCreateRepositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:create-repositories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the repositories needed for the tests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createFreshDirectory('tests/fixtures/git');
        $this->createFreshDirectory('tests/fixtures/git/does_not_exist');
        $this->createFreshDirectory('tests/fixtures/git/empty');
        $this->initialiseGitRepository('tests/fixtures/git/empty');
    }

    protected function createFreshDirectory($path)
    {
        $this->deleteExistingDirectory($path);
        $this->createDirectory($path);
    }

    protected function createDirectory($path)
    {
        $this->announceStep("Creating <comment>storage/app/$path</comment> directory");
        Storage::makeDirectory($path);
        $this->announceDone();
    }

    protected function deleteExistingDirectory($path)
    {
        $this->announceStep("Deleting existing <comment>storage/app/$path</comment> directory");
        Storage::deleteDirectory($path);
        $this->announceDone();
    }

    protected function announceStep($text)
    {
        $this->line('==> ' . $text);
    }

    protected function announceDone()
    {
        $this->info('    ✅ Done');
    }

    protected function initialiseGitRepository($path)
    {
        $this->announceStep("Creating git repository at <comment>storage/app/$path</comment>");
        shell_exec("cd " . storage_path("app/$path") . " && git init");
        $this->announceDone('');
    }
}
