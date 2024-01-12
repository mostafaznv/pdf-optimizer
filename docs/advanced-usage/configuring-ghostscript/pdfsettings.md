---
description: settings
---

# PDFSETTINGS

| Method Name | Argument Name | Argument Type                             |
| ----------- | ------------- | ----------------------------------------- |
| settings    | settings      | Mostafaznv\PdfOptimizer\Enums\PdfSettings |

Presets the `distiller parameters` to one of the following predefined settings:

* <mark style="color:red;">`/screen`</mark> selects low-resolution output similar to the Acrobat Distiller **Screen Optimized** setting.
* <mark style="color:red;">`/ebook`</mark> selects medium-resolution output similar to the Acrobat Distiller **eBook** setting.
* <mark style="color:red;">`/printer`</mark> selects output similar to the Acrobat Distiller **Print Optimized** setting.
* <mark style="color:red;">`/prepress`</mark> selects output similar to Acrobat Distiller **Prepress Optimized** setting.
* <mark style="color:red;">`/default`</mark> selects output intended to be useful across a wide variety of uses, possibly at the expense of a larger output file.



{% hint style="info" %}
Please be aware that the <mark style="color:red;">`/prepress`</mark> setting does not indicate the highest quality conversion. Using any of these presets will involve altering the input, and as such may result in a PDF of poorer quality (compared to the input) than simply using the defaults. The ‘best’ quality (where best means closest to the original input) is obtained by not setting this parameter at all (or by using <mark style="color:red;">/default</mark>).
{% endhint %}



The <mark style="color:red;">`PDFSETTINGS`</mark> presets should only be used if you are sure you understand that the output will be altered in a variety of ways from the input. It is usually better to adjust the controls individually if you have a genuine requirement to produce, for example, a PDF file where the images are reduced in resolution.



