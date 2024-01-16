---
description: autoFilterColorImages
---

# AutoFilterColorImages

| Method Name           | Argument Name | Argument Type |
| --------------------- | ------------- | ------------- |
| autoFilterColorImages | status        | boolean       |

If <mark style="color:red;">true</mark>, the compression filter for color images is chosen based on the properties of each image, in conjunction with the `ColorImageAutoFilterStrategy` setting.

If <mark style="color:red;">false</mark>, all color sampled images are compressed using the filter specified by ColorImageFilter.



{% hint style="info" %}
This setting is relevant only if <mark style="color:red;">EncodeColorImages</mark> is true.
{% endhint %}



