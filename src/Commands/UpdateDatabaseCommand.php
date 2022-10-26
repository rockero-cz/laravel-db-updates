<?php

namespace Rockero\DatabaseUpdates\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
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

    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return Command::FAILURE;
        }

        if ($this->argument('file')) {
            $this->comment('Updating: '.$this->argument('file'));

            $path = sprintf('%s/%s.php', $this->getPath(), $this->argument('file'));

            File::getRequire($path)->__invoke($this->output);

            $this->info('Done');

            return Command::SUCCESS;
        }

        $updates = collect(File::files($this->getPath()));

        $executedUpdates = DB::table('database_updates')->pluck('file')->all();

        $pendingUpdates = $updates->reject(fn (SplFileInfo $file) => in_array($file->getFilename(), $executedUpdates));

        $pendingUpdates->each(function (SplFileInfo $file) {
            $filename = $file->getFilename();

            $this->comment("Updating: {$filename}");

            File::getRequire($file)->__invoke($this->output);

            DB::table('database_updates')->insert([
                'file' => $file->getFilename(),
                'executed_at' => now()->toDateTimeString(),
            ]);

            $this->info("Updated: {$filename}");
        });

        return Command::SUCCESS;
    }

    public function getPath()
    {
        return $this->input->hasOption('realpath') && $this->option('realpath')
            ? $this->option('realpath')
            : database_path('updates');
    }
}
