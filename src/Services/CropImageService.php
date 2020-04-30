<?php
namespace Bytedigital123\ImageUpload\Services;

class cropImageService
{
    public function crop($image, $height, $width, $orientation)
    {

        switch ($orientation) {
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
