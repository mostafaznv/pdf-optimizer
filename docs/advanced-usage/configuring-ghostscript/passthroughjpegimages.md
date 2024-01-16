---
description: passThroughJpegImages
---

# PassThroughJPEGImages

| Method Name           | Argument Name | Argument Type |
| --------------------- | ------------- | ------------- |
| passThroughJpegImages | status        | boolean       |

If <mark style="color:red;">true</mark>, JPEG images (images that are already compressed with the DCTEncode filter) are `passed through` Distiller without re-compressing them. (Distiller does perform a decompression to ensure that images are not corrupt, but then passes the original compressed image to the PDF file.) Images that are not compressed will still be compressed according to the image settings in effect for the type of image (for example, ColorImageFilter , etc.).

If <mark style="color:red;">false</mark>, all JPEG encoded images are decompressed and recompressed according the compression settings in effect.



{% hint style="info" %}
However, that JPEG images that meet the following criteria are not passed through even if the value of <mark style="color:red;">PassThroughJPEGImages</mark> is true:



* The image will be downsampled.
* ColorConversionStrategy is sRGB and the current PostScript color space (for the image) is not DeviceRGB or DeviceGray.
* The image will be cropped—i.e., the clip path is such that more than 10% of the image pixels will be removed.
{% endhint %}

Creative Suite applications do not use this setting. However, Illustrator and InDesign normally behave as if it were true with regard to placed PDF files containing compressed images. That is, they do not normally uncompress and recompress them, unless color conversion or downsampling takes place.



