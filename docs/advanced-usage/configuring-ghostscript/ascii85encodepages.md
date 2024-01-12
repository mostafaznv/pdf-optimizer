---
description: ascii85EncodePages
---

# ASCII85EncodePages

| Method Name        | Argument Name | Argument Type |
| ------------------ | ------------- | ------------- |
| ascii85EncodePages | status        | boolean       |

If <mark style="color:red;">true</mark>, Distiller ASCII85-encodes binary streams such as page content streams, sampled images, and embedded fonts, resulting in a PDF file that is pure ASCII.

If <mark style="color:red;">false</mark>, Distiller does not encode the binary streams, resulting in a PDF file that may contain substantial amounts of binary data.



Distiller checks the value of this setting only once per document. Any change to it must be made before any marks are placed on the first page of the document.



