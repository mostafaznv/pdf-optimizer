---
description: lockDistillerParams
---

# LockDistillerParams

| Method Name         | Argument Name | Argument Type |
| ------------------- | ------------- | ------------- |
| lockDistillerParams | status        | boolean       |

If <mark style="color:red;">true</mark>, Distiller ignores any settings specified by setdistillerparams operators in the incoming PostScript file and uses only those settings present in the Adobe PDF settings file (or their default values if not present).

If <mark style="color:red;">false</mark>, any settings specified in the PostScript file override the initial settings. These settings are in effect for the duration of the current save level.





