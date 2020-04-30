<?php
namespace Bytedigital123\ImageUpload\Services;

class EncodeImageService
{
    public function encode($image, $level)
    {
        return $image->encode($extension, $level);

    }
}
