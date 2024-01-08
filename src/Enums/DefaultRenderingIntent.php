<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum DefaultRenderingIntent: string
{
    case DEFAULT               = '/Default';
    case PERCEPTUAL            = '/Perceptual';
    case SATURATION            = '/Saturation';
    case ABSOLUTE_COLORIMETRIC = '/AbsoluteColorimetric';
    case RELATIVE_COLORIMETRIC = '/RelativeColorimetric';
}
