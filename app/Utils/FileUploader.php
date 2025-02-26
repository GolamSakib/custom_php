<?php

namespace App\Utils;

class FileUploader
{
    public static function upload($fileInputName)
    {
        if (isset($_FILES[$fileInputName])) {
            $file = $_FILES[$fileInputName];
            // Check file size (2 MB limit)
            if ($file['size'] > 2 * 1024 * 1024) {
                return null;
            }
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $uploadFile = $uploadDir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                return $uploadFile;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
