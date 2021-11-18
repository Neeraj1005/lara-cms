<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where CMS will be accessible from. If the
    | domain is set to null, CMS will reside under the defined base
    | path below. Otherwise, this will be used as the subdomain.
    |
    */

    'domain' => env('CMS_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | Base Path
    |--------------------------------------------------------------------------
    |
    | This is the URI where CMS will be accessible from. If the prefix
    | is set to null, CMS will reside under the same prefix name as
    | the application. Otherwise, this is used as the base prefix.
    |
    */

    'prefix' => env('CMS_PREFIX', 'cms'),

    /*
    |--------------------------------------------------------------------------
    | Name of app
    |--------------------------------------------------------------------------
    |
    |
    */
    'name' => env('CMS_NAME', 'Lara-CMS'),

    /*
    |--------------------------------------------------------------------------
    | Your app url
    |--------------------------------------------------------------------------
    |
    |
    */
    'appUrl' => env('CMS_APP_URL', '/'),

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be attached to every route in CMS, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with the list.
    |
    */

    'middleware' => [
        'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    |
    | This is the storage disk CMS will use to put file uploads. You may
    | use any of the disks defined in the config/filesystems.php file and
    | you may also change the maximum upload size from its 3MB default.
    |
    */

    'storage_disk' => env('CMS_STORAGE_DISK', 'local'),

    'storage_path' => env('CMS_STORAGE_PATH', 'public/cms'),

    'upload_filesize' => env('CMS_UPLOAD_FILESIZE', 3145728),

    'asset_url' => null,

];
