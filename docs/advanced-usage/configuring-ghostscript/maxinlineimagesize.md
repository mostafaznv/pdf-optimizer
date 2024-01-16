---
description: maxInlineImageSize
---

# MaxInlineImageSize

| Method Name        | Argument Name | Argument Type |
| ------------------ | ------------- | ------------- |
| maxInlineImageSize | size          | integer       |

Specifies the maximum size of an inline image, <mark style="color:red;">in bytes</mark>. For images larger than this size, pdfwrite will create an <mark style="color:red;">XObject</mark> instead of embedding the image into the context stream.

The default value is <mark style="color:red;">4000</mark>.



{% hint style="info" %}
Note that redundant inline images must be embedded each time they occur in the document, while multiple references can be made to a single XObject image. Therefore, it may be advantageous to set a small or zero value if the source document is expected to contain multiple identical images, reducing the size of the generated PDF.
{% endhint %}



