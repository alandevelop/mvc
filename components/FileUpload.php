<?php

class FileUpload
{
    private $temp_file;

    public function __construct(array $temp_file)
    {
        $this->temp_file = $temp_file;
    }

    public function upload(): string
    {
        $fileTempName = $this->temp_file['tmp_name'];
        $newFilename = sha1_file($fileTempName);

        switch ($this->temp_file['type']) {
            case 'image/jpeg':
                $newFilename .= '.jpeg';
                break;
            case 'image/gif':
                $newFilename .= '.gif';
                break;
            case 'image/png':
                $newFilename .= '.png';
                break;
            default:
                return false;
        }

        $path = ROOT . '/web/uploads/' . $newFilename;

        if (move_uploaded_file($fileTempName, $path)) {
            return $newFilename;
        }

        return false;
    }
}