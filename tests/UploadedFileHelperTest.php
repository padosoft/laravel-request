<?php

namespace Padosoft\Laravel\Request\Test;

use Padosoft\Laravel\Request\UploadedFileHelper;
use Padosoft\Test\traits\ExceptionTestable;
use Padosoft\Test\traits\FileSystemTestable;
use Padosoft\Laravel\Request\UploadedFileTestable;

class UploadedFileHelperTest extends \phpunit\Framework\TestCase
{
    use ExceptionTestable, FileSystemTestable, UploadedFileTestable;

    protected function setUp() : void
    {
        //init files and paths needed for tests.
        $this->initFileAndPath(__DIR__);
    }

    protected function tearDown() : void
    {
        //remove created path during test
        $this->removeCreatedPathDuringTest(__DIR__);
    }

    /**
     * @test
     */
    public function hasValidMimeType()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');
        $arrMimeType = ['text/plain'];

        $this->assertTrue(UploadedFileHelper::hasValidMimeType($uploadedFile, $arrMimeType));
        $arrMimeType = ['text/plain', 'text/csv'];
        $this->assertTrue(UploadedFileHelper::hasValidMimeType($uploadedFile, $arrMimeType));
        $arrMimeType = ['text/csv'];
        $this->assertFalse(UploadedFileHelper::hasValidMimeType($uploadedFile, $arrMimeType));
    }

    /**
     * @test
     */
    public function getFilenameWithoutExtension()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');
        $this->assertEquals('dummy', UploadedFileHelper::getFilenameWithoutExtension($uploadedFile));
    }

    /**
     * @test
     */
    public function getFilenameWithExtension()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');
        $this->assertEquals('dummy.txt', UploadedFileHelper::getFilenameWithExtension($uploadedFile));
    }

    /**
     * @test
     */
    public function getFilenameExtension()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');
        $this->assertEquals('txt', UploadedFileHelper::getFilenameExtension($uploadedFile));
    }

    /**
     * @test
     */
    public function getDirname()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');
        $this->assertEquals(__DIR__ . '/resources', UploadedFileHelper::getDirname($uploadedFile));
    }

    /**
     * @test
     */
    public function isValidUploadFile()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');
        $arrMimeType = ['text/plain'];
        $this->assertTrue(UploadedFileHelper::isValidUploadFile($uploadedFile, $arrMimeType));

        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt', 'text/plain',
            UPLOAD_ERR_INI_SIZE);
        $this->assertFalse(UploadedFileHelper::isValidUploadFile($uploadedFile));
    }
}
