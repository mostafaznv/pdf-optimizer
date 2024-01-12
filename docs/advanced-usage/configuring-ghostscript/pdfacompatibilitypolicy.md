---
description: pdfACompatibilityPolicy
---

# PDFACompatibilityPolicy

| Method Name             | Argument Name | Argument Type |
| ----------------------- | ------------- | ------------- |
| pdfACompatibilityPolicy | policy        | int           |

When an operation (e.g. pdfmark) is encountered which cannot be emitted in a <mark style="color:red;">PDF/A</mark> compliant file, this policy is consulted, there are currently three possible values:

* <mark style="color:red;">**0:**</mark> (default) Include the feature or operation in the output file, the file will not be PDF/A compliant. Because the document Catalog is emitted before this is encountered, the file will still contain PDF/A metadata but will not be compliant. A warning will be emitted in this case.
* <mark style="color:red;">**1:**</mark> The feature or operation is ignored, the resulting PDF file will be PDF/A compliant. A warning will be emitted for every elided feature.
* <mark style="color:red;">**2:**</mark> Processing of the file is aborted with an error, the exact error may vary depending on the nature of the PDF/A incompatibility.



