<?php

namespace Mostafaznv\PdfOptimizer\Concerns;

use BackedEnum;
use Mostafaznv\PdfOptimizer\Attributes\Option;
use ReflectionClass;


trait ExportsScript
{
    public function command(?string $pathToFile = null, ?string $pathToOptimizedFile = null): array
    {
        $options = $this->options;
        $reflection = new ReflectionClass($this);

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Option::class);
            $value = $property->getValue($this);

            if (is_null($value)) {
                continue;
            }

            $value = is_a($value, BackedEnum::class) ? $value->value : $value;

            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();

                if (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                }

                $options[] = "$instance->name=$value";
            }
        }

        $command = array_merge([$this->gsBinary], $options, $this->extraOptions);

        if ($pathToOptimizedFile) {
            $command[] = "-sOutputFile=$pathToOptimizedFile";
        }

        if ($pathToFile) {
            $command[] = $pathToFile;
        }

        return $command;
    }

    public function toString(string $pathToFile = null, string $pathToOptimizedFile = null): string
    {
        return implode(' ', $this->command($pathToFile, $pathToOptimizedFile));
    }
}
