<?php
namespace Bytedigital123\ImageUpload\Services;

use Bytedigital123\ImageUpload\Services\OrientationService;

class ResizeImageService
{
    protected $orientation;
    protected $orientationService;

    public function __construct(OrientationService $orientationService)
    {
        $this->orientationService = $orientationService;

    }

    public function resize($file, $height, $width, $extension)
    {
        $this->orientation = $this->orientationService->getOrientation($file);

        switch ($this->orientation) {
            case 'landscape':

                $file->resize($width, null, function ($c) {
                    $c->aspectRatio();
                });

                $file->encode($extension, 100);
                break;

            case 'portrait':

                $file->resize($height, null, function ($c) {
                    $c->aspectRatio();
                });

                $file->encode($extension, 100);
                break;

            default:

                $file->widen($width, function ($c) {
                    $c->aspectRatio();
                });

                $file->encode($extension, 100);
                break;
        };

        return $file;

    }

}
