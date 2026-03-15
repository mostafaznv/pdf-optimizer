<?php

namespace Mostafaznv\PdfOptimizer\Attributes;

use Attribute;


#[Attribute(Attribute::TARGET_PROPERTY)]
class Flag
{
    public function __construct(public string $name) {}
}
