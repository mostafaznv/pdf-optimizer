# Timeout

Customize the timeout setting to exert control over the duration of the optimization process, allowing you to fine-tune the time allocated for the operation based on the specific requirements of your application or environment.



{% tabs %}
{% tab title="Standalone PHP" %}
By default processes have a timeout of 300 seconds, however you can change it passing a different timeout (in seconds) to the <mark style="color:red;">`setTimeout`</mark> method:&#x20;

```php
use Mostafaznv\PdfOptimizer\PdfOptimizer;

PdfOptimizer::init()->setTimeout(500)->optimize('input.pdf, 'output.pdf');
```
{% endtab %}

{% tab title="Laravel" %}
By default, processes have a timeout of 300 seconds, which is set by `config('pdf-optimizer.timeout')`. However, you can modify this timeout by passing a different duration (in seconds) to the <mark style="color:red;">`setTimeout`</mark> method:

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;

PdfOptimizer::open('input-1.pdf')
    ->setTimeout(500)
    ->optimize('output-1.pdf');
```
{% endtab %}
{% endtabs %}

