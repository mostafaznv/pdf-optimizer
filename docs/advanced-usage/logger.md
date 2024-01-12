# Logger

Integrate a custom logger into the pdf-optimizer package using the <mark style="color:red;">`logger`</mark> method. This empowers you to capture detailed logs and gain insights into the optimization process, aiding in debugging and monitoring.

A logger, is a class that implements <mark style="color:red;">`Psr\Log\LoggerInterface`</mark>, utilized for logging activities. A recommended logging library that fully complies with this interface is [Monolog](https://github.com/Seldaek/monolog). The pdf-optimizer package utilizes the logger to record information such as the Optimizers used, executed commands, and their respective outputs in the log files.



{% tabs %}
{% tab title="Standalone PHP" %}
```php
use App\Logger;
use Mostafaznv\PdfOptimizer\PdfOptimizer;

$logger = new Logger;

PdfOptimizer::init()->logger($logger)->optimize('input.pdf', 'output.pdf');
```
{% endtab %}

{% tab title="Laravel" %}
```php
use App\Logger;
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;

PdfOptimizer::open('input-1.pdf')
    ->logger(new Logger)
    ->optimize('output-1.pdf');
```
{% endtab %}
{% endtabs %}

