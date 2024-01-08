<?php

return [
    /*
    |--------------------------------------------------------------------------
    | GS Binary Path
    |--------------------------------------------------------------------------
    |
    | Path to GhostScript binary file.
    | You can use `which gs` command to find the path.
    | If you don't set this value, the package will use `gs` as default.
    |
    | Example: /usr/local/bin/gs
    |
    */

    'gs' => 'gs',

    /*
    |--------------------------------------------------------------------------
    | Queue
    |--------------------------------------------------------------------------
    |
    | Sometimes caching process is very heavy, so you have to queue the process and do it in background.
    |
    */

    'queue' => [
        'status'     => false,
        'name'       => 'default',
        'connection' => null
    ]
];
