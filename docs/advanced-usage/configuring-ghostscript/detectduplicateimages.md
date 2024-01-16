---
description: detectDuplicateImages
---

# DetectDuplicateImages

| Method Name           | Argument Name | Argument Type |
| --------------------- | ------------- | ------------- |
| detectDuplicateImages | status        | boolean       |

Takes a Boolean argument, when set to true (the default) pdfwrite will compare all new images with all the images encountered to date (NOT small images which are stored in-line) to see if the new image is a duplicate of an earlier one.

If it is a duplicate then instead of writing a new image into the PDF file, <mark style="color:red;">the PDF will reuse the reference to the earlier image</mark>. This can considerably reduce the size of the output PDF file, but increases the time taken to process the file.

This time grows exponentially as more images are added, and on large input files with numerous images can be prohibitively slow.&#x20;



{% hint style="info" %}
Setting this to false will improve performance at the cost of final file size.
{% endhint %}



