<?php
namespace Byte123\ImageUpload\Services;

use Byte123\ImageUpload\Services\OrientationService;

class cropImageService
{
    protected $orientationService;

    public function __construct(OrientationService $orientationService)
    {
        $this->orientationService = $orientationService;
    }

    public function crop($image, $height, $width)
    {
        $this->orientation = $this->orientationService->getOrientation($file);

        switch ($this->orientation) {
            case 'landscape':
                return $image->crop($width, $height);
                break;

            case 'portrait':
                return $image->crop($height, $width);
                break;

            default:
                return $image->crop($width, $height);
                break;
        };

        return $file;

    }
}
