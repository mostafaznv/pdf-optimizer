<?php

namespace Mostafaznv\PdfOptimizer\Laravel\Concerns;


class File
{
    private string  $path;
    private Disk    $diskInstance;


    public function __construct(string $path, ?string $disk = null)
    {
        $this->path = $path;
        $this->diskInstance = Disk::make($disk);
    }

    public function __destruct()
    {
        $this->cleanup();
    }

    public static function make(string $path, ?string $disk = null): self
    {
        return new static($path, $disk);
    }


    public function getDisk(): Disk
    {
        return $this->diskInstance;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getLocalPath(): string
    {
        $path = $this->getPath();
        $disk = $this->getDisk()->getAdapter();

        if ($disk) {
            if ($this->getDisk()->isLocalDisk()) {
                return $disk->path($path);
            }

            $temporaryDisk = $this->getDisk()->getTemporaryDisk();

            if (!$temporaryDisk->exists($path)) {
                $temporaryDisk->writeStream($path, $disk->readStream($path));
            }

            return $temporaryDisk->path($path);
        }

        return $path;
    }

    public function cleanup(): self
    {
        $this->getDisk()->cleanupTemporaryDirectory();

        return $this;
    }
}
