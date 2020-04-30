<?php
namespace Bytedigital123\ImageUpload\Services;

class OrientationService
{
    public function getOrientation($file)
    {
        list($img_width, $img_height) = getimagesize($file);

        if ($img_width > $img_height) {
            return 'landscape';
        } else {
            return 'portrait';
        }
    }
}
