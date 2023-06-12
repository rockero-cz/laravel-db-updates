<?php

namespace Rockero\DatabaseUpdates\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Console\View\Components\Info;
use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use SplFileInfo;

class UpdateDatabaseCommand extends Command
{
    use ConfirmableTrait;

    protected $signature = 'db:update {file?}
        {--force : Force the operation to run when in production}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}';

    protected $description = 'Run database updates';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (! $this->confirmToProceed()) {
            return Command::FAILURE;
        }

        $updates = collect($this->getUpdateFiles());

        $executedUpdates = DB::table('database_updates')->pluck('file')->all();

        $pendingUpdates = $updates->reject(fn (SplFileInfo $file) => in_array($file->getFilename(), $executedUpdates));

        if ($pendingUpdates->count() == 0) {
            $this->write(Info::class, 'Nothing to update.');

            return Command::SUCCESS;
        }

        $this->write(Info::class, 'Running updates.');

        $pendingUpdates->each(function (SplFileInfo $file) {
            $this->write(Task::class, $file->getFilename(), fn () => $this->runUpdate($file));
        });

        $this->output->writeln('');

        return Command::SUCCESS;
    }

    /**
     * Get the destination class path.
     */
    public function getPath(): string
    {
        return $this->input->hasOption('realpath') && $this->option('realpath')
            ? $this->option('realpath')
            : database_path('updates');
    }

    /**
     * Get database update files.
     */
    public function getUpdateFiles(): array
    {
        if ($this->argument('file')) {
            $path = sprintf('%s/%s.php', $this->getPath(), $this->argument('file'));
            $file = new SplFileInfo($path);

            return [$file];
        }

        return File::files($this->getPath());
    }

    /**
     * Run the database update.
     */
    protected function runUpdate(SplFileInfo $update): void
    {
        Benchmark::measure(function () use ($update) {
            File::getRequire($update)->__invoke();

            DB::table('database_updates')->insert([
                'file' => $update->getFilename(),
                'executed_at' => now(),
            ]);
        });
    }

    /**
     * Write down a line.
     */
    protected function write(string $component, ...$arguments): void
    {
        (new $component($this->output))->render(...$arguments);
    }
}
