---
description: monoImageDepth
---

# MonoImageDepth

| Method Name    | Argument Name | Argument Type                            |
| -------------- | ------------- | ---------------------------------------- |
| monoImageDepth | depth         | Mostafaznv\PdfOptimizer\Enums\ImageDepth |

Specifies the number of bits per sample in a downsampled image. Allowed values are:

* The number of bits per sample: <mark style="color:red;">1 , 2 , 4 , or 8</mark>
* When the value is <mark style="color:red;">greater than 1</mark>, monochrome images are converted to grayscale images.
* <mark style="color:red;">-1</mark> , which forces the downsampled image to have the same number of bits per sample as the original image. (For monochrome images, this is the same as a value of 1.)



<mark style="color:red;">MonoImageDepth</mark> is not used unless <mark style="color:red;">DownsampleMonoImages</mark> and <mark style="color:red;">AntiAliasMonoImages</mark> are <mark style="color:red;">true</mark>.



