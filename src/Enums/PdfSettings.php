<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum PdfSettings: string
{
    case SCREEN   = '/screen';
    case EBOOK    = '/ebook';
    case PRINTER  = '/printer';
    case PREPRESS = '/prepress';
    case DEFAULT  = '/default';
}
