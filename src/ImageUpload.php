<?php

namespace Bytedigital123\ImageUpload;

use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Bytedigital123\ImageUpload\Services\ResizeImageService;
use Bytedigital123\ImageUpload\Services\EncodeImageService;
use Bytedigital123\ImageUpload\Services\CropImageService;
use Bytedigital123\ImageUpload\ImageUpload;
use Bytedigital123\ImageUpload\BaseUpload;

class ImageUpload extends BaseUpload
{
    protected $resizeImageService;
    protected $cropImageService;
    protected $encodeImageService;
    public function __construct(
        ResizeImageService $resizeImageService,
        CropImageService $cropImageService,
        EncodeImageService $encodeImageService,
    ) {
        $this->resizeImageService = $resizeImageService;
        $this->cropImageService = $cropImageService;
        $this->encodeImageService = $encodeImageService;
    }

    /**
     * upload the file to the class
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function upload(UploadedFile $file)
    {
        $this->file = $file;

        $this->getFileInfo($file);

        $this->image = Image::make($file);

        return $this;
    }

    /**
     * save the image to the filesytem
     * specified
     *
     * @param string $filesystem
     * @return array
     */
    public function save(string $filesystem): array
    {
        $url = $this->saveImage($filesystem);

        return [
            'bytes' => filesize($this->file),
            'format' => $this->mime_type,
            'original_filename' => $this->name,
            'url' => $url,
        ];
    }

    /**
     * resize the image
     *
     * @param integer $height
     * @param integer $width
     * @return void
     */
    public function resize(int $height, int $width)
    {
        $this->image = $this->resizeImageService->resize($this->image, $height, $width, $this->extension, $this->orientation);

        return $this;
    }

    /**
     * crop the image
     *
     * @param integer $height
     * @param integer $width
     * @return void
     */
    public function crop(int $height, int $width)
    {
        $this->image = $this->cropImageService->crop($this->image, $height, $width, $this->orientation);

        return $this;
    }

    public function encode($level)
    {
        $this->image = $this->encodeImageService->encode($level);

        return $this;
    }

}
