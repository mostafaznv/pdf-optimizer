---
description: passThroughJpxImages
---

# PassThroughJPXImages

| Method Name          | Argument Name | Argument Type |
| -------------------- | ------------- | ------------- |
| passThroughJpxImages | status        | boolean       |

When <mark style="color:red;">true</mark> image data in the source which is encoded using the JPX (JPEG 2000) filter will not be decompressed and then recompressed on output. This prevents the multiplication of JPEG artefacts caused by lossy compression. <mark style="color:red;">PassThroughJPXImages</mark> currently only affects simple JPX encoded images. It has no effect on JPEG encoded images (see above) or masked images.&#x20;

In addition, this parameter will be ignored if the pdfwrite device needs to modify the source data. This can happen if the image is being downsampled, changing colour space or having transfer functions applied.&#x20;

Note that this parameter essentially overrides the EncodeColorImages and EncodeGrayImages parameters if they are false, the image will still be written with a JPXDecode filter. NB this feature currently only works with PostScript or PDF input, it does not work with PCL, PXL or XPS input.





