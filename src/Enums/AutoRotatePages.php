<?php

namespace Mostafaznv\PdfOptimizer\Enums;


enum AutoRotatePages: string
{
    case NONE         = '/None';
    case ALL          = '/All';
    case PAGE_BY_PAGE = '/PageByPage';
}
