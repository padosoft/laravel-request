<?php

namespace Padosoft\Laravel\Request;

use Illuminate\Http\UploadedFile;
use Padosoft\Io\FileHelper;

/**
 * UploadedFile Helper Class
 * @package Padosoft\Laravel\Request
 */
class UploadedFileHelper
{
    /**
     * Check if uploaded File is valid and
     * has a valid Mime Type (only if $arrMimeType is not empty array).
     * Return true is all ok, otherwise return false.
     * @param UploadedFile $uploadedFile
     * @param array $arrMimeType
     * @return bool
     */
    public static function isValidUploadFile(UploadedFile $uploadedFile, array $arrMimeType = array()) : bool
    {
        if (empty($uploadedFile) || !$uploadedFile->isValid()) {
            return false;
        }

        return self::hasValidMimeType($uploadedFile, $arrMimeType);
    }

    /**
     * Check if uploaded File has a correct MimeType if specified.
     * If $arrMimeType is empty array return true.
     * @param UploadedFile $uploadedFile
     * @param array $arrMimeType
     * @return bool
     */
    public static function hasValidMimeType(UploadedFile $uploadedFile, array $arrMimeType) : bool
    {
        return count($arrMimeType) > 0 ? in_array($uploadedFile->getMimeType(), $arrMimeType) : true;
    }

    /**
     * Return the file name of uploaded file (without path and witout extension).
     * Ex.: /public/upload/pippo.txt ritorna 'pippo'
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public static function getFilenameWithoutExtension(UploadedFile $uploadedFile)
    {
        return FileHelper::getFilenameWithoutExtension($uploadedFile->getClientOriginalName());
    }

    /**
     * Return the file name with extension of uploaded file (without path).
     * Ex.: /public/upload/pippo.txt ritorna 'pippo.txt'
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public static function getFilenameWithExtension(UploadedFile $uploadedFile)
    {
        return FileHelper::getFilename($uploadedFile->getClientOriginalName());
    }

    /**
     * Return the only file extension (without dot).
     * Ex.: /public/upload/pippo.txt ritorna 'txt'
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public static function getFilenameExtension(UploadedFile $uploadedFile)
    {
        return FileHelper::getFilenameExtension($uploadedFile->getClientOriginalName());
    }

    /**
     * Return the dir name of uploaded file (without file name and witout extension).
     * Ex.: /public/upload/pippo.txt ritorna '/public/upload'
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public static function getDirname(UploadedFile $uploadedFile)
    {
        return FileHelper::getDirname($uploadedFile->getPathname());
    }

}
