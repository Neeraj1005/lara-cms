<?php

namespace Neeraj1005\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

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

        // (new Filesystem)->ensureDirectoryExists(resource_path('sass/cms'));
        // (new Filesystem)->ensureDirectoryExists(resource_path('js/cms'));

        // NPM Packages...
        // $this->updateNodePackages(function ($packages) {
        //     return [
        //         'bootstrap' => '^4.6.0',
        //         'jquery' => '^3.6.0',
        //     ] + $packages;
        // });

        // $this->updateWebpackConfiguration();
        // $this->flushNodeModules();

        $this->info('Installation complete.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected function updateWebpackConfiguration()
    {
        file_put_contents(
            base_path('webpack.mix.js'),
            file_get_contents(dirname(__DIR__, 2) . '/resources/stubs/webpack.mix.stub'),
            FILE_APPEND
        );
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
