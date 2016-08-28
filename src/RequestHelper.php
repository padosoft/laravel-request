<?php

namespace Padosoft\Laravel\Request;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Illuminate\Http\Request helper
 * @package Padosoft\Laravel\Request
 */
class RequestHelper
{
    /**
     * Check if the current request has at least one file
     * @return bool
     */
    public static function currentRequestHasFiles() : bool
    {
        return self::requestHasFiles(request());
    }

    /**
     * Check if the passed request has at least one file
     * @param Request $request
     * @return bool
     */
    public static function requestHasFiles(Request $request) : bool
    {
        return ($request && $request->allFiles() && count($request->allFiles()) > 0);
    }

    /**
     * Check if uploaded File in current request is valid and has a valid Mime Type.
     * Return true is all ok, otherwise return false.
     * @param string $uploadField
     * @param array $arrMimeType
     * @return bool
     */
    public static function isValidCurrentRequestUploadFile(string $uploadField, array $arrMimeType = array()) : bool
    {
        return self::isValidUploadFile($uploadField, $arrMimeType, request());
    }

    /**
     * Check if uploaded File is valid and has a valid Mime Type.
     * Return true is all ok, otherwise return false.
     * @param string $uploadField
     * @param array $arrMimeType
     * @param Request $request
     * @return bool
     */
    public static function isValidUploadFile(string $uploadField, array $arrMimeType = array(), Request $request) : bool
    {
        $uploadedFile = self::getFileSafe($uploadField, $request);
        if ($uploadedFile === null || !is_a($uploadedFile, UploadedFile::class)) {
            return false;
        }

        return UploadedFileHelper::isValidUploadFile($uploadedFile, $arrMimeType);
    }

    /**
     * Return File in Current Request if ok, otherwise return null
     * @param string $uploadField
     * @return null|UploadedFile
     */
    public static function getCurrentRequestFileSafe(string $uploadField)
    {
        return self::getFileSafe($uploadField, request());
    }

    /**
     * Return File in passed request if ok, otherwise return null
     * @param string $uploadField
     * @param Request $request
     * @return null|UploadedFile
     */
    public static function getFileSafe(
        string $uploadField,
        Request $request
    ) {
        if (!$request || $uploadField === null || $uploadField == '') {
            return null;
        }

        $uploadedFile = $request->file($uploadField);

        //check type because request file method, may returns UploadedFile, array or null
        if (!is_a($uploadedFile, UploadedFile::class)) {
            return null;
        }

        return $uploadedFile;
    }
}
