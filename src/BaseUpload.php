<?php
namespace Bytedigital123\ImageUpload;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Bytedigital123\ImageUpload\Services\SanitizeFileName;

class BaseUpload
{
    protected $name;
    protected $image;
    protected $extension;
    protected $mime_type;
    protected $file;
    protected $orientation;
    protected $original_filename;

    /**
     * save the image to storage and return a url
     *
     * @param string $filesystem
     * @return string
     */
    protected function saveImage(string $filesystem): string
    {
        try {
            Storage::disk($filesystem)->put($this->name, $this->image);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }

        return Storage::disk($filesystem)->url($this->name);

    }

    protected function getFileInfo()
    {
        $this->getMimetype()->getFileExtension()->getFileName()->getOrientation();
    }

    private function getMimeType()
    {
        $this->mime_type = $this->file->getMimeType();

        return $this;
    }

    private function getFileExtension()
    {
        $this->extension = pathinfo($this->file->getClientOriginalName(), PATHINFO_EXTENSION);

        return $this;

    }

    private function getFileName()
    {
        $this->original_filename = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);

        $this->name = (new SanitizeFileName())->handle($this->original_filename) . '-' . Carbon::now()->format('Y-m-d-G-i-s') . '.' . $this->extension;

        return $this;

    }

    public function getOrientation()
    {
        list($img_width, $img_height) = getimagesize($this->file);

        if ($img_width > $img_height) {
            $this->orientation = 'landscape';
        } else {
            $this->orientation = 'portrait';
        }

        return $this;
    }
}
