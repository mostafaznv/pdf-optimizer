---
description: subsetFonts
---

# SubsetFonts

| Method Name | Argument Name | Argument Type |
| ----------- | ------------- | ------------- |
| subsetFonts | status        | boolean       |

If <mark style="color:red;">true</mark>, font subsetting is enabled.

If <mark style="color:red;">false</mark>, subsetting is not enabled. Font subsetting embeds only those glyphs that are used in a document, instead of the entire font. This reduces the size of a PDF file that contains embedded fonts. If font subsetting is enabled, the application determines whether to embed the entire font or a subset by the number of glyphs in the font that are used (including component glyphs referenced by `seac` glyphs), and the value of `MaxSubsetPct`.



