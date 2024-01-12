---
description: useFlateCompression
---

# UseFlateCompression

| Method Name         | Argument Name | Argument Type |
| ------------------- | ------------- | ------------- |
| useFlateCompression | status        | boolean       |

Because the <mark style="color:red;">LZW</mark> compression scheme was covered by patents at the time this device was created, pdfwrite does not actually use LZW compression: all requests for LZW compression are ignored. UseFlateCompression is treated as always on, but the switch CompressPages can be set too false to turn off page level stream compression. Now that the patent has expired, we could change this should it become worthwhile.



