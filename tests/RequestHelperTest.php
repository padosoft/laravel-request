<?php

namespace Padosoft\Laravel\Request\Test;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase as Orchestra;
use Mockery as m;
use Illuminate\Foundation\Application;
use Padosoft\Laravel\Request\RequestHelper;
use Padosoft\Test\traits\ExceptionTestable;
use Padosoft\Test\traits\FileSystemTestable;

class RequestHelperTest extends Orchestra
{
    use ExceptionTestable, FileSystemTestable, UploadedFileTestable;

    public function setUp()
    {
        parent::setUp();

        //init files and paths needed for tests.
        $this->initFileAndPath(__DIR__);
    }

    protected function tearDown()
    {
        //remove created path during test
        $this->removeCreatedPathDuringTest(__DIR__);
    }

    /**
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
    }

    /**
     * @test
     */
    public function requestHasFiles()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');

        $request = Request::create('/', 'GET', [], [], ['file' => $uploadedFile]);

        $this->assertTrue(RequestHelper::requestHasFiles($request));

        $this->app->instance(Request::class, $request);
        $this->app->instance('request', $request);
        $this->assertTrue(RequestHelper::currentRequestHasFiles());
    }

    /**
     * @test
     */
    public function getFileSafe()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');

        $request = Request::create('/', 'GET', [], [], ['file' => $uploadedFile]);

        $result = RequestHelper::getFileSafe('file', $request);
        $this->assertInstanceOf(UploadedFile::class, $result);
        $this->assertTrue($result->isValid());
        $this->assertEquals('dummy.txt', $result->getClientOriginalName());

        $result = RequestHelper::getFileSafe('', $request);
        $this->assertNull($result);

        $this->app->instance(Request::class, $request);
        $this->app->instance('request', $request);
        $result = RequestHelper::getCurrentRequestFileSafe('file');
        $this->assertInstanceOf(UploadedFile::class, $result);
        $this->assertTrue($result->isValid());
        $this->assertEquals('dummy.txt', $result->getClientOriginalName());
    }

    /**
     * @test
     */
    public function isValidUploadFile()
    {
        $uploadedFile = $this->getUploadedFileForTest(__DIR__ . '/resources/dummy.txt');

        $request = Request::create('/', 'GET', [], [], ['file' => $uploadedFile]);

        $this->assertTrue(RequestHelper::isValidUploadFile('file', [], $request));
        $this->assertFalse(RequestHelper::isValidUploadFile('', [], $request));

        $this->app->instance(Request::class, $request);
        $this->app->instance('request', $request);
        $this->assertTrue(RequestHelper::isValidCurrentRequestUploadFile('file'));
    }
}
