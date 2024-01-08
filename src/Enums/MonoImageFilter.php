<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum MonoImageFilter: string
{
    case CCITT      = '/CCITTFaxEncode';
    case FLATE      = '/FlateEncode';
    case RUN_LENGTH = '/RunLengthEncode';
}
