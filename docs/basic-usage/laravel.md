# Laravel

Leveraging the pdf-optimizer package within your Laravel applications allows for seamless optimization and compression of PDF files. With the Laravel-specific features provided by PdfOptimizer, including support for disks, queues, and comprehensive settings, you can efficiently tailor the optimization process to your application's needs.



```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\ColorConversionStrategy;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$result = PdfOptimizer::fromDisk('local')
    ->open('input-1.pdf')
    ->toDisk('s3')
    ->settings(PdfSettings::SCREEN)
    ->colorConversionStrategy(ColorConversionStrategy::DEVICE_INDEPENDENT_COLOR)
    ->colorImageResolution(50)
    ->optimize('output-1.pdf');


dd($result->status, $result->message);
```
