<?php

namespace Padosoft\Laravel\Request\Test;

use Illuminate\Http\UploadedFile;

trait UploadedFileTestable
{
    /**
     * Create an instance of Illuminate\Http\UploadedFile for testing (param test=true).
     * Before creating UploadedFile class check if file exists with assertFileExists($fullPath).
     * @param string $fullPath
     * @param string $mimeType if empty try to resolve mimeType automatically.
     * @param int $errorCode default 0 (no error).
     * For all possible values see Symfony\Component\HttpFoundation\File\UploadedFile::getErrorMessage()
     * @return UploadedFile
     */
    public function getUploadedFileForTest(string $fullPath, string $mimeType='', int $errorCode=0) : UploadedFile
    {
        $this->assertFileExists($fullPath);

        $uploadedFile = new UploadedFile(
            $fullPath,
            pathinfo($fullPath, PATHINFO_BASENAME),
            ($mimeType===null || $mimeType=='') ? mime_content_type($fullPath) : $mimeType,
            filesize($fullPath),
            $errorCode,
            true // true for test
        );
        return $uploadedFile;
    }
}
