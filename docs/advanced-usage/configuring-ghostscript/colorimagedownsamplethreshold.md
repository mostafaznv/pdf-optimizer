---
description: colorImageDownSampleThreshold
---

# ColorImageDownsampleThreshold

| Method Name                   | Argument Name | Argument Type |
| ----------------------------- | ------------- | ------------- |
| colorImageDownSampleThreshold | threshold     | float         |

Sets the downsample threshold for color images.

This is the ratio of image resolution to output resolution above which downsampling may be performed. <mark style="color:red;">Must be between 1.0 through 10.0, inclusive.</mark>



{% hint style="info" %}
If you set the threshold out of range, it reverts to a default of <mark style="color:red;">1.5</mark>
{% endhint %}

