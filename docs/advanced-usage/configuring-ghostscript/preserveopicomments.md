---
description: preserveOpiComments
---

# PreserveOPIComments

| Method Name         | Argument Name | Argument Type |
| ------------------- | ------------- | ------------- |
| preserveOpiComments | status        | boolean       |

If <mark style="color:red;">true</mark>, Distiller places the page contents within a set of Open Prepress Interface(OPI) comments in a Form XObject dictionary and preserves the OPI comment information in an OPI dictionary attached to the Form. Page contents data within a set of OPI comments may include proxy images, high-resolution images, or nothing.

If <mark style="color:red;">PreserveOPIComments</mark> is <mark style="color:red;">false</mark>, Distiller ignores OPI comments and their page contents. Setting PreserveOPIComments to false results in slightly simpler and smaller PDF files. Doing so is acceptable when use of an OPI server is not anticipated.



{% hint style="info" %}
Distiller ignores PreserveOPIComments if ParseDSCComments is false.
{% endhint %}



