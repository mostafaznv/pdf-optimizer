<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum ImageFilter: string
{
    case JPEG = '/DCTEncode';
    case ZIP  = '/FlateEncode';
}
