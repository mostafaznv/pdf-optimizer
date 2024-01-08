<?php

if (!function_exists('pdf_temp_dir')) {
    /**
     * Get temp directory
     *
     * @return string
     */
    function pdf_temp_dir(): string
    {
        // @codeCoverageIgnoreStart
        if (ini_get('upload_tmp_dir')) {
            $path = ini_get('upload_tmp_dir');
        }
        else if (getenv('temp')) {
            $path = getenv('temp');
        }
        // @codeCoverageIgnoreEnd
        else {
            $path = sys_get_temp_dir();
        }

        return rtrim($path, '/');
    }
}
