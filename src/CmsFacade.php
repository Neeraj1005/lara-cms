<?php

namespace Neeraj1005\Cms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Neeraj1005\Cms\Skeleton\SkeletonClass
 */
class CmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cms';
    }
}
