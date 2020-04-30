<?php
namespace Bytedigital123\ImageUpload;

class BaseUpload
{
    protected $name;
    protected $image;
    protected $extension;
    protected $mime_type;
    protected $file;

    protected function saveImage($filesystem)
    {
        try {
            return Storage::disk($filesystem)->put($this->name, $this->image);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    protected function getFileInfo()
    {
        $this->getMimetype()->getFileExtension()->getFileName();
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
        $name = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);

        $this->name = (new SanitizeFileName())->handle($name) . '-' . Carbon::now()->format('Y-m-d-G-i-s') . '.' . $this->extension;

        return $this;

    }
}
