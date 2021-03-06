<?php

namespace Neeraj1005\Cms\Presets;

use Illuminate\Filesystem\Filesystem;

class Bootstrap extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::updatePackages();
        static::updateWebpackConfiguration();
        static::updateSass();
        static::updateBootstrapping();
        // static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
            'bootstrap' => '^4.6.0',
            'jquery' => '^3.6',
            'popper.js' => '^1.16.1',
            'admin-lte' => '^3.1',
            '@fortawesome/fontawesome-free' => '^5.15.4',
            'sass' => '^1.32.11',
            'sass-loader' => '^11.0.1',
            'chart.js' => '^3.6.0',
            '@ckeditor/ckeditor5-build-classic' => '^31.0.0',
        ] + $packages;
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfiguration()
    {
        // copy(__DIR__ . '/bootstrap-stubs/webpack.mix.js', base_path('webpack.mix.js'));
        file_put_contents(
            base_path('webpack.mix.js'),
            file_get_contents(__DIR__ . '/bootstrap-stubs/webpack.mix.stub'),
            FILE_APPEND
        );
    }

    /**
     * Update the Sass files for the application.
     *
     * @return void
     */
    protected static function updateSass()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('sass'));
        copy(__DIR__ . '/bootstrap-stubs/_variables.scss', resource_path('sass/_variables.scss'));
        copy(__DIR__ . '/bootstrap-stubs/cms_app.scss', resource_path('sass/cms_app.scss'));
        copy(__DIR__ . '/bootstrap-stubs/frontend/cms_frontend_app.scss', resource_path('sass/cms_frontend_app.scss'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__ . '/bootstrap-stubs/cms_bootstrap.js', resource_path('js/cms_bootstrap.js'));
        copy(__DIR__ . '/bootstrap-stubs/frontend/cms_frontend_app.js', resource_path('js/cms_frontend_app.js'));
        copy(__DIR__ . '/bootstrap-stubs/ckeditor5.js', resource_path('js/ckeditor5.js'));
    }
}
