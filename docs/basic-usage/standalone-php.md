# Standalone PHP

Optimizing and compressing PDF files in your PHP applications is a breeze with the PdfOptimizer class. This class provides a simple and effective way to enhance the performance of your PDFs while minimizing file sizes.



```php
use Mostafaznv\PdfOptimizer\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\ColorConversionStrategy;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;


# input pdf file path
$file = 'path/to/large.pdf';

# output (optimized) pdf file path
$optimized = 'path/to/optimized.pdf';


# optimizing the pdf file
$result = PdfOptimizer::init()
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(60)
    ->colorConversionStrategy(ColorConversionStrategy::DEVICE_INDEPENDENT_COLOR)
    ->optimize($file, $optimized);


# check result
if ($result->status) {
    echo "PDF file optimized successfully!";
}
else {
    echo "Error: " . $result->message;
}
```
