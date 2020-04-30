<?php

namespace Bytedigital123\ImageUpload;

use Intervention\Image\Facades\Image;
use Bytedigital123\ImageUpload\Services\ResizeImageService;
use Bytedigital123\ImageUpload\Services\CropImageService;
use Bytedigital123\ImageUpload\BaseUpload;

class ImageUpload extends BaseUpload
{
    protected $resizeImageService;
    protected $cropImageService;

    public function __construct(
        ResizeImageService $resizeService,
        CropImageService $cropImageService
    ) {
        $this->resizeImageService = $resizeService;
        $this->cropImageService = $cropImageService;
    }

    public function addFile($file)
    {
        $this->file = $file;

        $this->getFileInfo($file);

        $this->image = Image::make($file);

        return $this;
    }

    public function upload($filesystem)
    {
        $url = $this->saveImage($filesystem);

        return [
            'bytes' => filesize($this->file),
            'format' => $this->mime_type,
            'original_filename' => $this->name,
            'url' => $url,
        ];
    }

    public function resize()
    {
        $this->image = $this->resizeImageService->resize($this->file, $height, $width);

        return $this;
    }

    public function crop($height, $width)
    {
        $this->image = $this->cropImageService->crop($this->file, $height, $width);

        return $this;
    }

}
