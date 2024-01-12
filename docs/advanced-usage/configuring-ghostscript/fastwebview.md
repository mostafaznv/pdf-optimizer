---
description: fastWebView
---

# FastWebView

| Method Name | Argument Name | Argument Type |
| ----------- | ------------- | ------------- |
| fastWebView | status        | boolean       |

Takes a Boolean argument, default is false.

When set to true pdfwrite will reorder the output PDF file to conform to the Adobe ‘linearised’ PDF specification. The Acrobat user interface refers to this as <mark style="color:red;">Optimised for Fast Web Viewing</mark>.



{% hint style="info" %}
Note that this will cause the conversion to PDF to be slightly slower and will usually result in a slightly larger PDF file. This option is incompatible with producing an encrypted (password protected) PDF file.
{% endhint %}



