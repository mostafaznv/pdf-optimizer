# PDF Optimizer

[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/mostafaznv/pdf-optimizer/run-tests.yml?branch=master&label=Build&style=flat-square&logo=github)](https://github.com/mostafaznv/pdf-optimizer/actions)
[![Codecov branch](https://img.shields.io/codecov/c/github/mostafaznv/pdf-optimizer/master.svg?style=flat-square&logo=codecov)](https://app.codecov.io/gh/mostafaznv/pdf-optimizer)
[![Quality Score](https://img.shields.io/scrutinizer/g/mostafaznv/pdf-optimizer.svg?style=flat-square)](https://scrutinizer-ci.com/g/mostafaznv/pdf-optimizer)
[![GitHub license](https://img.shields.io/github/license/mostafaznv/pdf-optimizer?style=flat-square)](https://github.com/mostafaznv/pdf-optimizer/blob/master/LICENSE)
[![Packagist Downloads](https://img.shields.io/packagist/dt/mostafaznv/pdf-optimizer?style=flat-square&logo=packagist)](https://packagist.org/packages/mostafaznv/pdf-optimizer)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/mostafaznv/pdf-optimizer.svg?style=flat-square&logo=composer)](https://packagist.org/packages/mostafaznv/pdf-optimizer)

PDF Optimizer is a powerful PHP package designed to optimize and compress PDF files effortlessly. Whether you're working on a `standalone PHP` project or a `Laravel` application, pdf-optimizer provides a seamless and efficient solution to reduce PDF file sizes using the popular `ghostscript` tool.

### Features
- **Fluent Method Chaining:** Enjoy a fluent and expressive API for optimizing PDF files with support for nearly all ghostscript options.
- **Laravel Integration:** Specifically tailored for Laravel applications, pdf-optimizer supports various input methods, including file `paths`, `UploadedFile`, and `disk` storage. This ensures flexibility and ease of use within the Laravel ecosystem.
- **Queue Support:** Optimize PDF files asynchronously with Laravel queues. pdf-optimizer seamlessly integrates with Laravel's queue system for efficient background processing.


----
I am on an open-source journey 🚀, and I wish I could solely focus on my development path without worrying about my financial situation. However, as life is not perfect, I have to consider other factors.

Therefore, if you decide to use my packages, please kindly consider making a donation. Any amount, no matter how small, goes a long way and is greatly appreciated. 🍺

[![Donate](https://mostafaznv.github.io/donate/donate.svg)](https://mostafaznv.github.io/donate)

<br>


## Requirements:

- PHP 8.2 or higher
- [Ghostscript](https://ghostscript.com/)

<br>

## Install Ghostscript

**Ubuntu**
```shell
apt-get install ghostscript
```

**Alpine**
```shell
apk add --upgrade ghostscript
```

**MacOS**
```shell
brew install ghostscript
```

**Windows** (not tested)
- Download and install [Ghostscript](https://www.ghostscript.com/download/gsdnld.html)
- Add Ghostscript to your system path
- Restart your computer

<br>

## Install Package

1. ##### Install the package via composer:
    ```shell
    composer require mostafaznv/pdf-optimizer
    ```

2. ##### Publish config file (Laravel only):
    ```shell
    php artisan vendor:publish --provider="Mostafaznv\PdfOptimizer\PdfOptimizerServiceProvider"
    ```

3. ##### Done

<br>

## Usage

### Standalone PHP

```php
use Mostafaznv\PdfOptimizer\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\ColorConversionStrategy;

$file = 'path/to/large.pdf';
$optimized = 'path/to/optimized.pdf';

$result = PdfOptimizer::init()
    ->compressFonts()
    ->colorImageResolution(60)
    ->colorConversionStrategy(ColorConversionStrategy::DEVICE_INDEPENDENT_COLOR)
    ->optimize($file, $optimized);

var_dump($result);
```

### Laravel

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\ColorConversionStrategy;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$result = PdfOptimizer::fromDisk('files')
    ->open('input-1.pdf')
    ->toDisk('s3')
    ->settings(PdfSettings::SCREEN)
    ->colorConversionStrategy(ColorConversionStrategy::DEVICE_INDEPENDENT_COLOR)
    ->colorImageResolution(50)
    ->onQueue()
    ->optimize('output-1.pdf');

dd($result);
```

----
I am on an open-source journey 🚀, and I wish I could solely focus on my development path without worrying about my financial situation. However, as life is not perfect, I have to consider other factors.

Therefore, if you decide to use my packages, please kindly consider making a donation. Any amount, no matter how small, goes a long way and is greatly appreciated. 🍺

[![Donate](https://mostafaznv.github.io/donate/donate.svg)](https://mostafaznv.github.io/donate)

----



## License

This software is released under [The MIT License (MIT)](LICENSE).
