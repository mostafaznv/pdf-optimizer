# Queue

pdf-optimizer introduces a powerful feature that allows you to <mark style="color:red;">queue</mark> the optimization of your files seamlessly within the Laravel framework. Queueing files provides a convenient and efficient way to handle optimization tasks <mark style="color:red;">asynchronously</mark>, improving the responsiveness and performance of your application.



### Key Benefits

* **Asynchronous Processing:** Queueing enables the optimization of files in the background, preventing long processing times from affecting the user experience.
* **Scalability:** Easily handle large batches of files by distributing optimization tasks across multiple workers, ensuring optimal resource utilization.
* **Improved Performance:** By offloading optimization to the queue, your application remains responsive, providing a smoother user experience.



There are two ways to enable the queue for optimizing processes. You can enable it globally through the <mark style="color:red;">`configuration`</mark> file or selectively using <mark style="color:red;">`onQueue`</mark> wherever you want to optimize a file.



***

### Usage

{% tabs %}
{% tab title="Using Method" %}
```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;

$result = PdfOptimizer::fromDisk('minio')
    ->open('input.pdf')
    ->toDisk('files')
    ->onQueue()
    ->optimize('output.pdf');
```

The `onQueue` method accepts four optional arguments:

* <mark style="color:blue;">**enabled (boolean):**</mark> Responsible for enabling or disabling the queue. It is set to true by default.
* <mark style="color:blue;">**name (string):**</mark> Customizes the queue name, which is set to the `default` value by default.
* <mark style="color:blue;">**connection (string):**</mark> Customizes the connection of the queue process. It defaults to null.
* <mark style="color:blue;">**timeout (int):**</mark> Sets the timeout for processes during the queue job.
{% endtab %}

{% tab title="Using Config File" %}
{% code title="config/pdf-optimizer.php" %}
```php
return [
    // ...
    
    'queue' => [
        'enabled'    => true,
        'name'       => 'default',
        'connection' => null,
        'timeout'    => 900 // seconds (15 minutes)
    ]
];
```
{% endcode %}

```php
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;

$result = PdfOptimizer::fromDisk('minio')
    ->open('input.pdf')
    ->toDisk('files')
    ->optimize('output.pdf');
```
{% endtab %}
{% endtabs %}

{% hint style="info" %}
The <mark style="color:red;">`PdfOptimizer`</mark> class returns an <mark style="color:red;">`OptimizeResult`</mark> object that contains two properties:

* **isQueued (boolean):** Indicates whether the optimization process has been queued. Defaults to false.
* **queueId (string):** Provides an <mark style="color:red;">`orderedUuid`</mark> for the queued optimization job.



You can store the <mark style="color:red;">`queueId`</mark> in your database and monitor the optimization's result by listening to the <mark style="color:red;">`PdfOptimizerJobFinished`</mark> event.
{% endhint %}



***

### Job Completion Event

`pdf-optimizer` provides an event that fires when an optimization job finishes processing in the queue. This event can be used to perform additional actions once the job is complete, such as sending a notification to a user or updating a database record. The event can be listened to using Laravel's built-in event system, and it provides access to the <mark style="color:red;">`ID`</mark> of optimization job, status of the optimization process, and the message of executed command. \
To utilize this feature, you need to create an event listener and register it. Once the job is completed, `pdf-optimizer` will notify your listener and provide the necessary information.



1. **Craete a Listener**

```bash
php artisan make:listener PdfOptimizerJobNotification
```

2. **Register Listener**

{% code title="App\Providers\EventServiceProvider" %}
```php
use Mostafaznv\PdfOptimizer\Events\PdfOptimizerJobFinished;
use App\Listeners\PdfOptimizerJobNotification;
 

protected $listen = [
    PdfOptimizerJobFinished::class => [
        PdfOptimizerJobNotification::class,
    ],
];
```
{% endcode %}

3. **Listen to Notification**

```php
<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Mostafaznv\PdfOptimizer\Events\PdfOptimizerJobFinished;


class PdfOptimizerJobNotification
{
    public function handle(PdfOptimizerJobFinished $event)
    {
        Log::info("pdf optimization finished:");
        Log::info("id: $event->id");
        Log::info("status: $event->status");
        Log::info("message: $event->message");
    }
}
```





