<?php

namespace Byte123\ImageUpload\Services;

class SanitizeFileName
{
    public function handle($file_name)
    {
        return preg_replace('/[^a-z0-9]+/', '_', strtolower($file_name));
    }
}
