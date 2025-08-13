# Introduction

[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/mostafaznv/pdf-optimizer/run-tests.yml?branch=main\&label=Build\&style=flat-square\&logo=github)](https://github.com/mostafaznv/pdf-optimizer/actions) [![Codecov branch](https://img.shields.io/codecov/c/github/mostafaznv/pdf-optimizer/main.svg?style=flat-square\&logo=codecov)](https://app.codecov.io/gh/mostafaznv/pdf-optimizer) [![Quality Score](https://img.shields.io/scrutinizer/g/mostafaznv/pdf-optimizer.svg?style=flat-square)](https://scrutinizer-ci.com/g/mostafaznv/pdf-optimizer) [![GitHub license](https://img.shields.io/github/license/mostafaznv/pdf-optimizer?style=flat-square)](https://github.com/mostafaznv/pdf-optimizer/blob/main/LICENSE) [![Packagist Downloads](https://img.shields.io/packagist/dt/mostafaznv/pdf-optimizer?style=flat-square\&logo=packagist)](https://packagist.org/packages/mostafaznv/pdf-optimizer) [![Latest Version on Packagist](https://img.shields.io/packagist/v/mostafaznv/pdf-optimizer.svg?style=flat-square\&logo=composer)](https://packagist.org/packages/mostafaznv/pdf-optimizer)



**PDF Optimizer** stands as a robust PHP package meticulously crafted for effortless optimization and compression of PDF files. Whether you are engaged in a <mark style="color:red;">`standalone PHP`</mark> project or navigating the <mark style="color:red;">`Laravel`</mark> landscape, pdf-optimizer emerges as a powerful solution, utilizing the well-known <mark style="color:red;">`ghostscript`</mark> tool to significantly reduce PDF file sizes.



[![Donate](https://mostafaznv.github.io/donate/donate.svg)](https://mostafaznv.github.io/donate)





### Key Features

* **Fluent Method Chaining:** Experience the elegance of a fluent and expressive API that seamlessly optimizes PDF files. Harness the power of nearly all ghostscript options with ease.
* **Logger Support:** Capture detailed logs to gain profound insights into the intricacies of the optimization process. Stay informed and in control with the integrated logger.
* **Customization:** Tailor the optimization process to your exact needs. pdf-optimizer provides a customizable solution, allowing you to fine-tune your PDF optimization experience.
* **Laravel Integration:** Specifically designed for Laravel applications, pdf-optimizer supports diverse input methods, including <mark style="color:red;">`file paths`</mark>, <mark style="color:red;">`UploadedFile`</mark> instances, and <mark style="color:red;">`disk`</mark> storage. This guarantees flexibility and user-friendly integration within the Laravel ecosystem.
* **Queue Support:** Elevate your optimization process with asynchronous PDF file optimization using Laravel queues. pdf-optimizer seamlessly integrates with Laravel's queue system, ensuring efficient background processing.





{% hint style="warning" %}
**License Notice**

This package is licensed under the MIT License.

It <mark style="color:red;">does not</mark> include the Ghostscript. However, it requires Ghostscript to be installed on the server in order to function. Ghostscript is licensed separately under the <mark style="color:red;">AGPL</mark> or a <mark style="color:red;">commercial license</mark> from Artifex. If you choose the AGPL version of Ghostscript, you <mark style="color:red;">must</mark> comply with the AGPL terms in your own application.

Please ensure you have the appropriate Ghostscript license for your use case.
{% endhint %}
