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
    | Process Timeout
    |--------------------------------------------------------------------------
    |
    | Set timeout to control how long the process should run.
    | If the timeout is reached, a ProcessTimedOutException will be thrown.
    |
    | Default: 300 seconds (5 minutes)
    |
    */

    'timeout' => 300,


    /*
    |--------------------------------------------------------------------------
    | Queue
    |--------------------------------------------------------------------------
    |
    | Sometimes optimizing process is very heavy, so you have to queue the
    | process and do it in background.
    |
    */

    'queue' => [
        'enabled'    => false,
        'name'       => 'default',
        'connection' => null,
        'timeout'    => 900 // seconds (15 minutes)
    ]
];
