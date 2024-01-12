# Ghostscript Binary Configuration

Customize the Ghostscript binary path used by pdf-optimizer to match your environment. This option provides flexibility in specifying the exact location of the Ghostscript binary on your server.





{% tabs %}
{% tab title="Standalone PHP" %}
You can specify the exact path to the Ghostscript binary file by passing it to the <mark style="color:red;">`init`</mark> method of the `PdfOptimizer` class.

```php
use Mostafaznv\PdfOptimizer\PdfOptimizer;

PdfOptimizer::init('/path/to/gs')->optimize('input.pdf', 'output.pdf');
```
{% endtab %}

{% tab title="Laravel" %}
You can specify the exact path to the Ghostscript binary file using the <mark style="color:red;">`setGsBinary`</mark> method of the `PdfOptimizer` class.

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;

PdfOptimizer::fromDisk('files')
    ->open('input-1.pdf')
    ->setGsBinary('/usr/local/bin/gs')
    ->toDisk('s3')
    ->optimize('output-1.pdf');
```



**Note:** The `setGsBinary` method must be called after the `fromDisk` and `open` methods. This option is specifically available during the exporting phase of the optimization process.
{% endtab %}
{% endtabs %}

