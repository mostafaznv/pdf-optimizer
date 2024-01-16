# Filesystem

`pdf-optimizer` seamlessly integrates with <mark style="color:red;">Laravel</mark>, offering versatile file optimization capabilities. **This feature extends beyond local paths, allowing you to optimize files from various sources, including remote disks and UploadedFile instances.**&#x20;

Explore the flexibility of optimizing files and storing them across different disks within the Laravel ecosystem.



Here is some detailed examples:

<details>

<summary>UploadedFile -> Disk</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;
use Illuminate\Http\UploadedFile;


$file = new UploadedFile(
    public_path('files/input.pdf'), 'input.pdf'
);

$result = PdfOptimizer::open($file)
    ->toDisk('minio')
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize('output.pdf');
    
dd($result);
```

</details>

<details>

<summary>UploadedFile -> File Path</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;
use Illuminate\Http\UploadedFile;

$outputFilePath = public_path('files/output.pdf');
$file = new UploadedFile(
    public_path('files/input.pdf'), 'input.pdf'
);

$result = PdfOptimizer::open($file)
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize($outputFilePath);
    
dd($result);
```

</details>

<details>

<summary>File Path -> File Path</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$inputFilePath = public_path('files/input.pdf');
$outputFilePath = public_path('files/output.pdf');

$result = PdfOptimizer::open($inputFilePath)
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize($outputFilePath);
    
dd($result);
```

</details>

<details>

<summary>File Path -> Disk</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$filePath = public_path('files/input.pdf');

$result = PdfOptimizer::open($filePath)
    ->toDisk('minio')
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize('output.pdf');
    
dd($result);
```

</details>

<details>

<summary>Disk -> File Path</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$outputFilePath = public_path('files/output.pdf')

$result = PdfOptimizer::fromDisk('minio')
    ->open('input.pdf')
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize($outputFilePath);
    
dd($result);
```

</details>

<details>

<summary>Remote Disk -> Remote Disk</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$result = PdfOptimizer::fromDisk('minio')
    ->open('input.pdf')
    ->toDisk('minio')
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize('output.pdf');
    
dd($result);
```

</details>

<details>

<summary>Remote Disk -> Local Disk</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$result = PdfOptimizer::fromDisk('minio')
    ->open('input.pdf')
    ->toDisk('local')
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize('output.pdf');
    

dd($result);
```

</details>

<details>

<summary>Local Disk -> Remote Disk</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$result = PdfOptimizer::fromDisk('local')
    ->open('input.pdf')
    ->toDisk('minio')
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize('output.pdf');
    
dd($result);
```

</details>

<details>

<summary>Local Disk -> Local Disk</summary>

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;

$result = PdfOptimizer::fromDisk('local')
    ->open('input.pdf')
    ->toDisk('local')
    ->settings(PdfSettings::SCREEN)
    ->colorImageResolution(50)
    ->optimize('output.pdf');
    
dd($result);
```

</details>

