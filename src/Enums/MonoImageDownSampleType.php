<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum MonoImageDownSampleType: string
{
    case SUB_SAMPLE = '/Subsample';
    case AVERAGE    = '/Average';
    case BICUBIC    = '/Bicubic';
}
