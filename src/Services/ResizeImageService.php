<?php
namespace Bytedigital123\ImageUpload\Services;

class ResizeImageService
{
    public function resize($image, $height, $width, $extension, $orientation)
    {
        switch ($orientation) {
            case 'landscape':
                $image->resize($width, null, function ($c) {
                    $c->aspectRatio();
                });
                break;

            case 'portrait':
                $image->resize($height, null, function ($c) {
                    $c->aspectRatio();
                });
                break;

            default:
                $image->widen($width, function ($c) {
                    $c->aspectRatio();
                });
                break;
        };

        return $image;

    }

}
