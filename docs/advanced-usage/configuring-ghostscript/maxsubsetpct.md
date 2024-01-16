---
description: maxSubsetPct
---

# MaxSubsetPct

| Method Name  | Argument Name | Argument Type |
| ------------ | ------------- | ------------- |
| maxSubsetPct | max           | integer       |

The maximum percentage of glyphs in a font that can be used before the entire font is embedded instead of a subset.

<mark style="color:red;">The allowable range is 1 through 100.</mark>



Distiller only uses this value if SubsetFonts is true. For example, a value of 30 means that a font will be embedded in full (not subset) if more than 30% of glyphs are used; a value of 100 means all fonts will be subset no matter how many glyphs are used (because you cannot use more than 100% of glyphs).



