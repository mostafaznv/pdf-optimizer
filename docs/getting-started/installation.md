# Installation

### Requirements:

* PHP 8.2 or higher
* [Ghostscript](https://ghostscript.com)



### 1. Install Ghostscript

{% tabs %}
{% tab title="Ubuntu" %}
```shell
sudo apt update -y
sudo apt-get install ghostscript
```
{% endtab %}

{% tab title="Alpine" %}
```sh
sudo apk add --upgrade ghostscript
```
{% endtab %}

{% tab title="MacOS" %}
```bash
brew install ghostscript
```
{% endtab %}

{% tab title="Windows" %}
1. Download and install [Ghostscript](https://www.ghostscript.com/download/gsdnld.html)
2. Add Ghostscript to your system path
3. Restart your computer



<mark style="color:red;">Note:</mark> This package has not been tested on Windows machines. While it is designed to work seamlessly on Unix-based systems, users on Windows may experience compatibility issues.

We recommend testing the package in a Windows environment and welcome any feedback or contributions to enhance Windows compatibility. If you encounter issues or have suggestions for improving Windows support, please feel free to open an issue on our GitHub repository. Thank you for your understanding.
{% endtab %}
{% endtabs %}

### 2. Install the package via composer

```bash
composer require mostafaznv/pdf-optimizer
```

### 3. Publish config file (Laravel Only)

```bash
php artisan vendor:publish --provider="Mostafaznv\PdfOptimizer\PdfOptimizerServiceProvider"
```

{% hint style="info" %}
If you're using Laravel, this command publishes the configuration file, allowing you to customize pdf-optimizer settings.
{% endhint %}

### 4. Done





