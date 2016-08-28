# Laravel Package to interact with Illuminate Request and Files Upload.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/padosoft/laravel-request.svg?style=flat-square)](https://packagist.org/packages/padosoft/laravel-request)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/padosoft/laravel-request/master.svg?style=flat-square)](https://travis-ci.org/padosoft/laravel-request)
[![Quality Score](https://img.shields.io/scrutinizer/g/padosoft/laravel-request.svg?style=flat-square)](https://scrutinizer-ci.com/g/padosoft/laravel-request)
[![Total Downloads](https://img.shields.io/packagist/dt/padosoft/laravel-request.svg?style=flat-square)](https://packagist.org/packages/padosoft/laravel-request)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9482504c-ed2d-423f-94bb-1cf3a6babff0.svg?style=flat-square)](https://insight.sensiolabs.com/projects/9482504c-ed2d-423f-94bb-1cf3a6babff0)

This package provides a series of class to interact with Illuminate Request and Files Upload.

##Requires
  
- php: >=7.0.0
- illuminate/support: ^5.0
- illuminate/http: ^5.0
- padosoft/io: ^1.0
  
## Installation

You can install the package via composer:
``` bash
$ composer require padosoft/laravel-request
```

## Usage

```php
use Padosoft\Laravel\Request\RequestHelper;

if(RequestHelper::currentRequestHasFiles()){
    echo 'current request has file uploaded!'; 
}

if(RequestHelper::isValidCurrentRequestUploadFile('items_image', ['image/jpg','image/png'])){
    echo 'current request has a valid file uploaded!'; 
}

$uploadedFile = RequestHelper::getCurrentRequestFileSafe('items_image'); 
var_dump($uploadedFile);

```

**NOTE:**

For all methods and helpers check the source code.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email instead of using the issue tracker.

## Credits
- [Lorenzo Padovani](https://github.com/lopadova)
- [All Contributors](../../contributors)

## About Padosoft
Padosoft (https://www.padosoft.com) is a software house based in Florence, Italy. Specialized in E-commerce and web sites.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
