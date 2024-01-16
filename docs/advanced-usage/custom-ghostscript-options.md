# Custom Ghostscript Options

For scenarios where the existing configuration options may not cover your specific needs, the <mark style="color:red;">`setExtraOptions`</mark> method allows you to inject custom Ghostscript options directly into the optimization script. This flexibility ensures that no aspect of the optimization process is beyond your control.



{% tabs %}
{% tab title="Standalone PHP" %}
```php
use Mostafaznv\PdfOptimizer\PdfOptimizer;


PdfOptimizer::init()
    ->setExtraOptions([
        '-dCustom1=true',
        '-dCustom2=false'
    ])
    ->optimize('input.pdf', 'output.pdf');
```
{% endtab %}

{% tab title="Laravel" %}
```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;

PdfOptimizer::open('input-1.pdf')
    ->setExtraOptions([
        '-dCustom1=true',
        '-dCustom2=false'
    ])
    ->optimize('output-1.pdf');
```
{% endtab %}
{% endtabs %}

