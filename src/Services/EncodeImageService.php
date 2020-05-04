<?php
namespace Bytedigital123\ImageUpload\Services;

class EncodeImageService
{
    public function encode($image, $extension, $level)
    {
        return $image->encode($extension, $level);
    }
}
