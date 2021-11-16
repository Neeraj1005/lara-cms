<?php

namespace Neeraj1005\Cms\Console;

use Illuminate\Console\Command;
use Neeraj1005\Cms\Presets\Bootstrap;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laracms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the lara-cms components and resources';

    /**
     * Create a new console command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        if (file_exists(config_path('cms.php'))) {
            $this->setHidden(true);
        }
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->callSilent('vendor:publish', ['--tag' => 'lara-cms-config']);

        $this->callSilent('migrate', [
            '--path' => 'vendor/neeraj1005/cms/database/migrations',
        ]);

        Bootstrap::install();

        $this->info('Installation complete.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }
}
