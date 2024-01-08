<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum ColorImageDownSampleType: string
{
    case SUB_SAMPLE = '/Subsample';
    case AVERAGE    = '/Average';
    case BICUBIC    = '/Bicubic';
}
