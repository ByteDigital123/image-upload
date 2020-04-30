<?php

namespace Bytedigital123\ImageUpload;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bytedigital123\O,ageUpload\Skeleton\SkeletonClass
 */
class ImageUploadFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'image-upload';
    }
}
