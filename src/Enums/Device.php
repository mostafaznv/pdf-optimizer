<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum Device: string
{
    /**
     * High-level (vector) file formats
     */

    /** EPS output (like PostScript Distillery) */
    case EPSWRITE = 'eps2write';
    /** PDF output (like Adobe Acrobat Distiller) */
    case PDFWRITE = 'pdfwrite';
    /** PostScript output (like PostScript Distillery) */
    case PSWRITE = 'ps2write';
    /** Black-and-white PCL XL */
    case PXLMONO = 'pxlmono';
    /** Color PCL XL */
    case PXLCOLOR = 'pxlcolor';

    /**
     * Other raster file formats and devices
     */

    /** Plain bits, monochrome */
    case BIT = 'bit';
    /** Plain bits, RGB */
    case BITRGB = 'bitrgb';
    /** Plain bits, CMYK */
    case BITCMYK = 'bitcmyk';
    /** Monochrome MS Windows .BMP file format */
    case BMPMONO = 'bmpmono';
    /** 8-bit gray .BMP file format */
    case BMPGRAY = 'bmpgray';
    /** Separated 1-bit CMYK .BMP file format, primarily for testing */
    case BMPSEP1 = 'bmpsep1';
    /** Separated 8-bit CMYK .BMP file format, primarily for testing */
    case BMPSEP8 = 'bmpsep8';
    /** 4-bit (EGA/VGA) .BMP file format */
    case BMP4 = 'bmp16';
    /** 8-bit (256-color) .BMP file format */
    case BMP8 = 'bmp256';
    /** 24-bit .BMP file format */
    case BMP24 = 'bmp16m';
    /** 32-bit pseudo-.BMP file format */
    case BMP32 = 'bmp32b';
    /** Monochrome (black-and-white) CGM -- LOW LEVEL OUTPUT ONLY */
    case CGMMONO = 'cgmmono';
    /** 8-bit (256-color) CGM -- DITTO */
    case CGM8 = 'cgm8';
    /** 24-bit color CGM -- DITTO */
    case CGM24 = 'cgm24';
    /** JPEG format, RGB output */
    case JPEG = 'jpeg';
    /** JPEG format, gray output */
    case JPEGGRAY = 'jpeggray';
    /** ImageMagick MIFF format, 24-bit direct color, RLE compressed */
    case MIFF = 'miff24';
    /** PCX file format, monochrome (1-bit black and white) */
    case PCXMONO = 'pcxmono';
    /** PCX file format, 8-bit gray scale */
    case PCXGRAY = 'pcxgray';
    /** PCX file format, 4-bit planar (EGA/VGA) color */
    case PCX4 = 'pcx16';
    /** PCX file format, 8-bit chunky color */
    case PCX8 = 'pcx256';
    /** PCX file format, 24-bit color (3 8-bit planes) */
    case PCX24 = 'pcx24b';
    /** PCX file format, 4-bit chunky CMYK color */
    case PCXCMYK = 'pcxcmyk';
    /** Portable Bitmap (plain format) */
    case PBM = 'pbm';
    /** Portable Bitmap (raw format) */
    case PBMRAW = 'pbmraw';
    /** Portable Graymap (plain format) */
    case PGM = 'pgm';
    /** Portable Graymap (raw format) */
    case PGMRAW = 'pgmraw';
    /** Portable Graymap (plain format), optimizing to PBM if possible */
    case PGNM = 'pgnm';
    /** Portable Graymap (raw format), optimizing to PBM if possible */
    case PGNMRAW = 'pgnmraw';
    /** Portable Pixmap (plain format) (RGB), optimizing to PGM or PBM if possible */
    case PNM = 'pnm';
    /** Portable Pixmap (raw format) (RGB), optimizing to PGM or PBM if possible */
    case PNMRAW = 'pnmraw';
    /** Portable Pixmap (plain format) (RGB) */
    case PPM = 'ppm';
    /** Portable Pixmap (raw format) (RGB) */
    case PPMRAW = 'ppmraw';
    /** Portable inKmap (plain format) (4-bit CMYK => RGB) */
    case PKM = 'pkm';
    /** Portable inKmap (raw format) (4-bit CMYK => RGB) */
    case PKMRAW = 'pkmraw';
    /** Portable Separated map (plain format) (4-bit CMYK => 4 pages) */
    case PKSM = 'pksm';
    /** Portable Separated map (raw format) (4-bit CMYK => 4 pages) */
    case PKSMRAW = 'pksmraw';
    /** Plan 9 bitmap format */
    case PLAN9BM = 'plan9bm';
    /** Monochrome Portable Network Graphics (PNG) */
    case PNGMONO = 'pngmono';
    /** 8-bit gray Portable Network Graphics (PNG) */
    case PNGGRAY = 'pnggray';
    /** 4-bit color Portable Network Graphics (PNG) */
    case PNG4 = 'png16';
    /** 8-bit color Portable Network Graphics (PNG) */
    case PNG8 = 'png256';
    /** 24-bit color Portable Network Graphics (PNG) */
    case PNG24 = 'png16m';
    /** PostScript (Level 1) monochrome image */
    case PSMONO = 'psmono';
    /** PostScript (Level 1) 8-bit gray image */
    case PSGRAY = 'psgray';
    /** PostScript (Level 2) 24-bit color image */
    case PSRGB = 'psrgb';
    /** TIFF 12-bit RGB, no compression */
    case TIFF12 = 'tiff12nc';
    /** TIFF 24-bit RGB, no compression (NeXT standard format) */
    case TIFF24 = 'tiff24nc';
    /** TIFF LZW (tag = 5) (monochrome) */
    case TIFFLZW = 'tifflzw';
    /** TIFF PackBits (tag = 32773) (monochrome) */
    case TIFFPACK = 'tiffpack';
}
