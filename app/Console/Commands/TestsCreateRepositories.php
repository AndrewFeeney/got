<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestsCreateRepositories extends Command
{
    const STORAGE_SUBDIRECTORY = "tests/fixtures/git";

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
        $this->createFreshDirectory();
        $this->createFreshDirectory('does_not_exist');
        $this->createFreshDirectory('empty');
        $this->initialiseGitRepository('empty');
        $this->initialiseGitRepository('single_commit');
        $this->writeTextToFile('<?php echo "hello world";', 'single_commit/hello_world.php');
    }

    protected function createFreshDirectory($relativePath = null)
    {
        $this->deleteExistingDirectory($relativePath);
        $this->createDirectory($relativePath);
    }

    protected function createDirectory($relativePath)
    {
        $this->announceStep("Creating new " . $this->commentedRelativePath($relativePath) . " directory");
        Storage::makeDirectory($this->relativePath($relativePath));
        $this->announceDone();
    }

    protected function deleteExistingDirectory($relativePath)
    {
        $this->announceStep("Deleting existing " . $this->commentedRelativePath($relativePath) . " directory");
        Storage::deleteDirectory($this->relativePath($relativePath));
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

    protected function initialiseGitRepository($relativePath)
    {
        $this->announceStep("Creating git repository at " . $this->commentedRelativePath($relativePath));
        shell_exec("cd " . $this->appStoragePath($relativePath) . " && git init");
        $this->announceDone();
    }

    protected function appStoragePath($relativePath)
    {
        return storage_path("app/" . $this->relativePath($relativePath));
    }

    protected function relativePath($relativePath)
    {
        return self::STORAGE_SUBDIRECTORY . "/$relativePath";
    }

    protected function commentedRelativePath($relativePath)
    {
        return "<comment>storage/app/" . $this->relativePath($relativePath) . "</comment>";
    }

    protected function writeTextToFile($text, $relativePath)
    {
        $this->announceStep("Writing " . $this->commentedRelativePath($relativePath));
        Storage::delete($this->relativePath($relativePath));
        Storage::put($this->relativePath($relativePath), $text);
        $this->announceDone();
    }
}
