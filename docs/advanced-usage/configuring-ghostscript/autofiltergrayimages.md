---
description: autoFilterGrayImages
---

# AutoFilterGrayImages

| Method Name          | Argument Name | Argument Type |
| -------------------- | ------------- | ------------- |
| autoFilterGrayImages | status        | boolean       |

If <mark style="color:red;">true</mark>, the compression filter for gray images is chosen based on the properties of each image, in conjunction with the GrayImageAutoFilterStrategy setting.

If <mark style="color:red;">false</mark>, all color sampled images are compressed using the filter specified by GrayImageFilter.



{% hint style="info" %}
This setting is relevant only if <mark style="color:red;">EncodeGrayImages</mark> is true.
{% endhint %}



